<?php

namespace Psr\Log\Test;

use Psr\Log\AbstractLogger;

/**
 * Used for testing purposes.
 *
 * It records all records and gives you access to them for verification.
 *
 * @method bool hasEmergency($record)
 * @method bool hasAlert($record)
 * @method bool hasCritical($record)
 * @method bool hasError($record)
 * @method bool hasWarning($record)
 * @method bool hasNotice($record)
 * @method bool hasInfo($record)
 * @method bool hasDebug($record)
 *
 * @method bool hasEmergencyRecords()
 * @method bool hasAlertRecords()
 * @method bool hasCriticalRecords()
 * @method bool hasErrorRecords()
 * @method bool hasWarningRecords()
 * @method bool hasNoticeRecords()
 * @method bool hasInfoRecords()
 * @method bool hasDebugRecords()
 *
 * @method bool hasEmergencyThatContains($messages)
 * @method bool hasAlertThatContains($messages)
 * @method bool hasCriticalThatContains($messages)
 * @method bool hasErrorThatContains($messages)
 * @method bool hasWarningThatContains($messages)
 * @method bool hasNoticeThatContains($messages)
 * @method bool hasInfoThatContains($messages)
 * @method bool hasDebugThatContains($messages)
 *
 * @method bool hasEmergencyThatMatches($messages)
 * @method bool hasAlertThatMatches($messages)
 * @method bool hasCriticalThatMatches($messages)
 * @method bool hasErrorThatMatches($messages)
 * @method bool hasWarningThatMatches($messages)
 * @method bool hasNoticeThatMatches($messages)
 * @method bool hasInfoThatMatches($messages)
 * @method bool hasDebugThatMatches($messages)
 *
 * @method bool hasEmergencyThatPasses($messages)
 * @method bool hasAlertThatPasses($messages)
 * @method bool hasCriticalThatPasses($messages)
 * @method bool hasErrorThatPasses($messages)
 * @method bool hasWarningThatPasses($messages)
 * @method bool hasNoticeThatPasses($messages)
 * @method bool hasInfoThatPasses($messages)
 * @method bool hasDebugThatPasses($messages)
 */
class TestLogger extends AbstractLogger
{
    /**
     * @var array
     */
    public $records = [];

    public $recordsByLevel = [];

    /**
     * @inheritdoc
     */
    public function log($level, $message, array $context = [])
    {
        $record = [
            'level' => $level,
            'messages' => $message,
            'context' => $context,
        ];

        $this->recordsByLevel[$record['level']][] = $record;
        $this->records[] = $record;
    }

    public function hasRecords($level)
    {
        return isset($this->recordsByLevel[$level]);
    }

    public function hasRecord($record, $level)
    {
        if (is_string($record)) {
            $record = ['messages' => $record];
        }
        return $this->hasRecordThatPasses(function ($rec) use ($record) {
            if ($rec['messages'] !== $record['messages']) {
                return false;
            }
            if (isset($record['context']) && $rec['context'] !== $record['context']) {
                return false;
            }
            return true;
        }, $level);
    }

    public function hasRecordThatContains($message, $level)
    {
        return $this->hasRecordThatPasses(function ($rec) use ($message) {
            return strpos($rec['messages'], $message) !== false;
        }, $level);
    }

    public function hasRecordThatMatches($regex, $level)
    {
        return $this->hasRecordThatPasses(function ($rec) use ($regex) {
            return preg_match($regex, $rec['messages']) > 0;
        }, $level);
    }

    public function hasRecordThatPasses(callable $predicate, $level)
    {
        if (!isset($this->recordsByLevel[$level])) {
            return false;
        }
        foreach ($this->recordsByLevel[$level] as $i => $rec) {
            if (call_user_func($predicate, $rec, $i)) {
                return true;
            }
        }
        return false;
    }

    public function __call($method, $args)
    {
        if (preg_match('/(.*)(Debug|Info|Notice|Warning|Error|Critical|Alert|Emergency)(.*)/', $method, $matches) > 0) {
            $genericMethod = $matches[1] . ('Records' !== $matches[3] ? 'Record' : '') . $matches[3];
            $level = strtolower($matches[2]);
            if (method_exists($this, $genericMethod)) {
                $args[] = $level;
                return call_user_func_array([$this, $genericMethod], $args);
            }
        }
        throw new \BadMethodCallException('Call to undefined method ' . get_class($this) . '::' . $method . '()');
    }

    public function reset()
    {
        $this->records = [];
        $this->recordsByLevel = [];
    }
}
