<?php
$data = json_decode(file_get_contents(__DIR__.'/../mou3_data.json'), true);
echo "MoU Title/Perihal: " . ($data['mou']['perihal'] ?? '') . "\n";
echo "MoU Customer: " . ($data['mou']['nama_customer'] ?? '') . "\n";
echo "Sections count: " . count($data['sections']) . "\n\n";

foreach ($data['sections'] as $idx => $sec) {
    echo "[$idx] ID: {$sec['id']} | Title: {$sec['title']}\n";
    $blocks = json_decode($sec['content'], true);
    if (is_array($blocks)) {
        foreach ($blocks as $bIdx => $block) {
            echo "    Block $bIdx type: " . ($block['type'] ?? 'unknown') . "\n";
            if (isset($block['content'])) {
                echo "      Content snippet: " . substr(strip_tags($block['content']), 0, 80) . "...\n";
            }
        }
    }
}
