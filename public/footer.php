<?php

use SebastianBergmann\Timer\ResourceUsageFormatter;


if (isset($timer)) {
    $resourceUsage = (new ResourceUsageFormatter)->resourceUsage($timer->stop());
} else {
    $resourceUsage = "Информация о ресурсах недоступна";
}
?>

<footer>
    <div class="admin-panel-info">
        <p><?= htmlspecialchars($resourceUsage); ?></p>
    </div>
</footer>

<style>
    footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        padding: 1px 10px;
        background-color: #333;
        color: white;
        text-align: left;
        font-size: 14px;
    }

    .admin-panel-info {
        font-weight: bold;
    }
</style>



