<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Jenssegers\Agent\Agent;

class VisitorController extends Controller
{
    private static $agent;

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

        $visitor = Visitor::where('ip', $ip)
            ->where('browser', $browser)
            ->where('platform', $platform)
            ->first();

        if (empty($visitor)) {
            $visitor = Visitor::create([
                'ip' => $ip,
                'browser' => $browser,
                'platform' => $platform,
                'referer' => $_SERVER['HTTP_REFERER'] ?? null,
            ]);
        }

        $visitor->referer = $_SERVER['HTTP_REFERER'] ?? null;
        $visitor->save();

        return $visitor;
    }

    private static function getAgent(): Agent
    {
        if (self::$agent === null) {
            self::$agent = new Agent();
        }

        return self::$agent;
    }
}
