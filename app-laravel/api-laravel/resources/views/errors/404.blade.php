<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,follow">
    <meta name="description"
          content="Sorry, the page you are looking for doesn't exist or has been moved. Please return to our homepage or go back to the previous page.">
    <title>404 Page Not Found</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            display: grid;
            place-items: center;
            color: #1a202c;
        }

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            padding: 2rem;
            text-align: center;
            max-width: 600px;
            width: 90%;
        }

        h1 {
            font-size: clamp(4rem, 15vw, 8rem);
            margin: 0;
            line-height: 1;
        }

        p {
            margin: 0;
            max-width: 50ch;
            line-height: 1.5;
        }

        .message {
            font-size: clamp(1.5rem, 5vw, 2rem);
            font-weight: 500;
        }

        .buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn {
            padding: .75rem 1.5rem;
            background: #4299e1;
            color: white;
            text-decoration: none;
            border-radius: .5rem;
            transition: background-color .2s;
            font-weight: 500;
        }

        .btn:hover,
        .btn:focus {
            background: #3182ce;
            outline: none;
        }

        .btn-green {
            background: #48bb78;
        }

        .btn-green:hover,
        .btn-green:focus {
            background: #2f855a;
        }

        @media (prefers-reduced-motion: reduce) {
            .btn {
                transition: none;
            }
        }
    </style>
</head>
<body>
<main>
    <h1>404</h1>
    <p class="message">Page Not Found</p>
    <p>Sorry, the page you are looking for doesn't exist or has been moved. Please try returning to our homepage or
        going back to the previous page.</p>
    <div class="buttons">
        <a href="/" class="btn btn-green">🏠 Homepage</a>
        <a href="#" class="btn js-back">↩️ Go Back</a>
    </div>
</main>

<script>
  document.querySelector('.js-back').addEventListener('click', (e) => {
    e.preventDefault()
    window.history.back()
  })
</script>
</body>
</html>

