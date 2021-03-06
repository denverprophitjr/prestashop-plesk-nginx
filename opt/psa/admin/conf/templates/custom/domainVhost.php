<?php echo AUTOGENERATED_CONFIGS; ?>
<?php

if ($VAR->domain->disabled) {
    echo "# Domain is disabled\n";
    return;
}

echo ALLOW_VHOSTCONF;
echo '#' . $VAR->domain->physicalHosting->customConfigFile . "\n";

if ($VAR->domain->physicalHosting->ssl) {
    echo '#' . $VAR->domain->physicalHosting->customSslConfigFile . "\n";
}

if ($VAR->domain->physicalHosting->ssl) {
    foreach ($VAR->domain->physicalHosting->ipAddresses as $ipAddress) {
        if ($ipAddress->defaultDomainId != $VAR->domain->id) {
            echo $VAR->includeTemplate('domain/domainVirtualHost.php', array(
                'ssl' => true,
                'ipAddress' => $ipAddress,
            ));
        }
    }
}

foreach ($VAR->domain->physicalHosting->ipAddresses as $ipAddress) {
    if ($ipAddress->defaultDomainId != $VAR->domain->id) {
        echo $VAR->includeTemplate('domain/domainVirtualHost.php', array(
            'ssl' => false,
            'ipAddress' => $ipAddress,
        ));
    }
}
