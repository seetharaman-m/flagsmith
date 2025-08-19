<?php
require 'vendor/autoload.php';

use Flagsmith\Flagsmith;

$flagsmith = new Flagsmith('F3GGuxvQv4f5HnndtLsx5p'); // Replace with your key

function isDeleteButtonVisible($flagsmith) {
    try {
        $flags = $flagsmith->getEnvironmentFlags();
        return $flags->isFeatureEnabled('show_delete_button');
    } catch (Exception $e) {
        error_log("Flagsmith error: " . $e->getMessage());
        return false;
    }
}
// Function to check if the beta feature should be visible
function isBetaFeatureVisible($flagsmith) {
    try {
        $flags = $flagsmith->getEnvironmentFlags();
        return $flags->isFeatureEnabled('show_beta_feature');
    } catch (Exception $e) {
        error_log("Flagsmith error (beta feature): " . $e->getMessage());
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flagsmith PHP PoC</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .item { margin: 10px 0; padding: 10px; border: 1px solid #ccc; }
        .delete-btn { background-color: #ff4444; color: white; padding: 5px 10px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Flagsmith PHP Proof of Concept</h1>
    <div class="item">
        Sample Item
        <?php if (isDeleteButtonVisible($flagsmith)): ?>
            <button class="delete-btn">Delete</button>
        <?php else: ?>
            <span></span>
        <?php endif; ?>
    </div>
    <div class="item">
        <?php if (isBetaFeatureVisible($flagsmith)): ?>
            <div class="beta-section">
                <h2>Beta Feature</h2>
                <p>This is a new beta feature only visible in the Development environment!</p>
            </div>
        <?php else: ?>
            <span>Beta feature hidden by feature flag</span>
        <?php endif; ?>
    </div>
</body>
</html>
