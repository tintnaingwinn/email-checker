<?php

namespace Tintnaingwin\EmailChecker;

/**
 * Class EmailChecker
 *
 * @package Titnnaingwin\EmailChecker
 */
class EmailChecker {

    /**
     * PHP Socket
     * @var  $socket
     */
    protected $socket;

    /**
     * @var $user
     */
    protected $user;

    /**
     * @var $domain
     */
    protected $domain;

    /**
     * @var $from_email
     */
    protected $from_email = 'me@example.com';

    /**
     * SMTP Port
     * @var $port 25
     */
    protected $port = 25;

    /**
     * Maximum Connection Time to an MTA
     */
    protected $max_conn_time = 30;

    /**
     * Maximum Read Time from socket
     */
    protected $max_read_time = 5;

    /**
     * @var $nameServers
     */
    protected $nameServers = ['192.168.0.1'];


    public function check($email = false)
    {
        $disposable = json_decode(file_get_contents(__DIR__.'/json/list.json'),true);

        if ($email) {
            $this->setEmail($email);
        }

        if (in_array($this->domain, $disposable)){
            return false;
        }

        $mxs = [];

        list($hosts, $mxRecords) = $this->queryMX($this->domain);

        for($n=0; $n < count($hosts); $n++){
            $mxs[$hosts[$n]] = $mxRecords[$n];
        }

        asort($mxs);

        array_push($mxs, $this->domain);

        $timeout = $this->max_conn_time/(count($hosts)>0 ? count($hosts) : 1);

        // connect to SMTP
        foreach ($mxs as $host => $value)
        {
            if ($this->socket = @fsockopen($host, $this->port, $errno, $errstr, (float) $timeout))
            {
                stream_set_timeout($this->socket, $this->max_read_time);
                break;
            }
        }

        if ($this->socket)
        {
            $reply = fread($this->socket, 2082);

            preg_match('/^([0-9]{3})/ims', $reply, $matches);
            $code = isset($matches[1]) ? $matches[1] : '';

            if($code != '220')
            {
                $result = false;
            }

            $this->send("helo hi");

            $this->send("MAIL FROM: <".$this->from_email.">");

            // ask of rcpt
            $reply = $this->send("RCPT TO: <".$email.">");

            // parse code and message
            preg_match('/^([0-9]{3}) /ims', $reply, $matches);
            $code = isset($matches[1]) ? $matches[1] : '';

            if ($code == '250') {
                // accepted
                $result = true;
            } elseif ($code == '451' || $code == '452') {
                $result = true;
            } else {
                $result = false;
            }

            $this->quit();

        }else
        {
            $result = false;
        }

        return $result;
    }


    protected function send($msg)
    {
        fwrite($this->socket, $msg."\r\n");

        $reply = fread($this->socket, 2082);

        return $reply;
    }

    protected function parseEmail($email)
    {
        $parts = explode('@', $email);
        $domain = array_pop($parts);
        $user= implode('@', $parts);
        return [$user, $domain];
    }

    protected function setEmail($email)
    {
        $parts = $this->parseEmail($email);
        $this->user = $parts[0];
        $this->domain = $parts[1];
    }

    protected function queryMX($domain)
    {
        $hosts = [];
        $mxRecords = [];
        if (function_exists('getmxrr'))
        {
            getmxrr($domain, $hosts, $mxRecords);
        } else
        {
            // windows, we need Net_DNS
            require_once 'Net/DNS.php';

            $resolver = new Net_DNS_Resolver();

            // nameservers to query
            $resolver->nameServers = $this->nameServers;
            $resp = $resolver->query($domain, 'MX');
            if ($resp)
            {
                foreach($resp->answer as $answer)
                {
                    $hosts[] = $answer->exchange;
                    $mxRecords[] = $answer->preference;
                }
            }
        }
        return array($hosts, $mxRecords);
    }

    protected function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    protected function quit()
    {
        // quit
        $this->send("quit");
        // close socket
        fclose($this->socket);
    }

}

