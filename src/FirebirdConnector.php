<?php

namespace Firebird;

use Exception;
use Illuminate\Database\Connectors\Connector;
use Illuminate\Database\Connectors\ConnectorInterface;
use PDO;

class FirebirdConnector extends Connector implements ConnectorInterface
{
    /**
     * Establish a database connection.
     *
     * @param array $config
     * @return PDO
     * @throws Exception
     */
    public function connect(array $config)
    {
        $options = $this->getOptions($config);
        $path = $config['database'];
        $charset = $config['charset'];
        $host = $config['host'];
		
		$dsn_role = '';
        if (isset($config['role'])) {
            $dsn_role .= ";role=" . $config['role'];
        }
        return $this->createConnection("firebird:dbname={$host}:{$path};charSet={$charset}", $config, $options);
    }
}
