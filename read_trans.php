<?php
$lines = file('C:/Users/MUHAMMAD EKA/.gemini/antigravity-ide/brain/ec714c06-aa6e-4a00-911c-71189398dbd6/.system_generated/logs/transcript.jsonl');
foreach ($lines as $line) {
    $j = json_decode($line, true);
    $idx = $j['step_index'] ?? 0;
    if ($idx == 568 || $idx == 569 || $idx == 570) {
        echo '=== STEP ' . $idx . ' ===' . PHP_EOL;
        print_r($j);
    }
}
