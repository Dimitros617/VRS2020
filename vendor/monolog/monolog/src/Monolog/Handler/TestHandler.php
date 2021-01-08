<?php declare(strict_types=1);

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Monolog\Logger;

/**
 * Used for testing purposes.
 *
 * It records all records and gives you access to them for verification.
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
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
class TestHandler extends AbstractProcessingHandler
{
    protected $records = [];
    protected $recordsByLevel = [];
    private $skipReset = false;

    public function getRecords()
    {
        return $this->records;
    }

    public function clear()
    {
        $this->records = [];
        $this->recordsByLevel = [];
    }

    public function reset()
    {
        if (!$this->skipReset) {
            $this->clear();
        }
    }

    public function setSkipReset(bool $skipReset)
    {
        $this->skipReset = $skipReset;
    }

    /**
     * @param string|int $level Logging level value or name
     */
    public function hasRecords($level): bool
    {
        return isset($this->recordsByLevel[Logger::toMonologLevel($level)]);
    }

    /**
     * @param string|array $record Either a messages string or an array containing messages and optionally context keys that will be checked against all records
     * @param string|int   $level  Logging level value or name
     */
    public function hasRecord($record, $level): bool
    {
        if (is_string($record)) {
            $record = array('messages' => $record);
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

    /**
     * @param string|int $level Logging level value or name
     */
    public function hasRecordThatContains(string $message, $level): bool
    {
        return $this->hasRecordThatPasses(function ($rec) use ($message) {
            return strpos($rec['messages'], $message) !== false;
        }, $level);
    }

    /**
     * @param string|int $level Logging level value or name
     */
    public function hasRecordThatMatches(string $regex, $level): bool
    {
        return $this->hasRecordThatPasses(function (array $rec) use ($regex): bool {
            return preg_match($regex, $rec['messages']) > 0;
        }, $level);
    }

    /**
     * @psalm-param callable(array, int): mixed $predicate
     *
     * @param string|int $level Logging level value or name
     * @return bool
     */
    public function hasRecordThatPasses(callable $predicate, $level)
    {
        $level = Logger::toMonologLevel($level);

        if (!isset($this->recordsByLevel[$level])) {
            return false;
        }

        foreach ($this->recordsByLevel[$level] as $i => $rec) {
            if ($predicate($rec, $i)) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $record): void
    {
        $this->recordsByLevel[$record['level']][] = $record;
        $this->records[] = $record;
    }

    public function __call($method, $args)
    {
        if (preg_match('/(.*)(Debug|Info|Notice|Warning|Error|Critical|Alert|Emergency)(.*)/', $method, $matches) > 0) {
            $genericMethod = $matches[1] . ('Records' !== $matches[3] ? 'Record' : '') . $matches[3];
            $level = constant('Monolog\Logger::' . strtoupper($matches[2]));
            if (method_exists($this, $genericMethod)) {
                $args[] = $level;

                return call_user_func_array([$this, $genericMethod], $args);
            }
        }

        throw new \BadMethodCallException('Call to undefined method ' . get_class($this) . '::' . $method . '()');
    }
}
