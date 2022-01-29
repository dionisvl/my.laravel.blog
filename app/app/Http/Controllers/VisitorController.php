<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Jenssegers\Agent\Agent;

class VisitorController extends Controller
{
    private static $agent;

    private static function getAgent(): Agent
    {
        if (self::$agent === null) {
            self::$agent = new Agent();
        }

        return self::$agent;
    }

    /**
     * Create new visitor if it is not robot
     * and it has unique params as browser, platform etc.
     * @return bool|Visitor
     */
    public static function getVisitor()
    {
        $agent = self::getAgent();

        if ($agent->isRobot()) {
            return false;
        }

        $ip = request()->ip();
        $browser = $agent->browser();
        $platform = $agent->platform();
        $referer = $_SERVER['HTTP_REFERER'] ?? null;
        $referer = substr($referer, 0, 255);

        $visitor = Visitor::where('ip', $ip)
            ->where('browser', $browser)
            ->where('platform', $platform)
            ->first();

        if (empty($visitor)) {
            $visitor = Visitor::create(
                [
                    'ip' => $ip,
                    'browser' => $browser,
                    'platform' => $platform,
                    'referer' => $referer,
                ]
            );
        } else {
            $visitor->referer_last = $referer;
        }

        $visitor->save();

        return $visitor;
    }

}
