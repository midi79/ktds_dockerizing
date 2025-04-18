<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['api'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PHP GET/POST Test</title>
  <style>
    body { font-family: sans-serif; padding: 2rem; }
    button { margin: 0.5rem; padding: 0.5rem 1rem; }
    pre { background: #f0f0f0; padding: 1rem; }
  </style>
</head>
<body>
  <h1>PHP Web Service Demo</h1>
  <button onclick="sendGet()">Send GET Request</button>
  <button onclick="sendPost()">Send POST Request</button>
  <pre id="output">Response will appear here...</pre>

  <script>
    async function sendGet() {
      const res = await fetch('?api=1');
      const data = await res.json();
      document.getElementById('output').textContent = JSON.stringify(data, null, 2);
    }

    async function sendPost() {
      const res = await fetch('', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ text: 'This is dummy text' })
      });
      const data = await res.json();
      document.getElementById('output').textContent = JSON.stringify(data, null, 2);
    }
  </script>
</body>
</html>
<?php
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['api'])) {
    header('Content-Type: application/json');
    echo json_encode([
        'message' => 'Hello from PHP server!'
    ]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $input = json_decode(file_get_contents('php://input'), true);
    $text = isset($input['text']) ? $input['text'] : 'No text provided';
    echo json_encode([
        'received' => $text
    ]);
} else {
    http_response_code(405);
    echo json_encode([
        'error' => 'Method not allowed'
    ]);
}
