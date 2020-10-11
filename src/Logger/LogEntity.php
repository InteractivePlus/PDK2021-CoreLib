<?php
namespace InteractivePlus\PDK2021Base\Logger;
class LogEntity{
    public $actionID = 0;
    private $_appuid = 0;
    public $time = 0;
    private $_logLevel = PDKLogLevel::INFO;
    public $message = NULL;
    public $success = false;
    public $PDKExceptionCode = 0;
    private $_context = array();
    public $clientAddr = NULL;

    public function __construct(
        int $actionID, 
        int $appUID, 
        int $time, 
        int $logLevel, 
        bool $success,
        int $PDKExceptionCode = 0,
        ?string $clientAddr = NULL,
        ?string $message = NULL, 
        ?array $context = NULL
    ){
        if($context === NULL){
            $context = array();
        }
        $this->actionID = $actionID;
        $this->_appuid = $appUID;
        $this->time = $time;
        $this->_logLevel = PDKLogLevel::fixLogLevel($logLevel);
        $this->success = $success;
        $this->PDKExceptionCode = $PDKExceptionCode;
        $this->clientAddr = $clientAddr;
        $this->message = $message;
        $this->_context = $context;
    }
    public function getAPPUID() : int{
        return $this->_appuid;
    }
    public function withAPPUID(int $appuid) : LogEntity{
        $clonedEntity = clone $this;
        $clonedEntity->_appuid = $appuid;
        return $clonedEntity;
    }
    public function getLogLevel() : int{
        return $this->_logLevel;
    }
    public function withLogLevel(int $logLevel) : LogEntity{
        $clonedEntity = clone $this;
        $clonedEntity->_logLevel = PDKLogLevel::fixLogLevel($logLevel);
        return $clonedEntity;
    }
    public function getContexts() : array{
        return $this->_context;
    }
    public function withContexts(?array $newContext) : LogEntity{
        $clonedEntity = clone $this;
        $clonedEntity->_context = $newContext;
        return $clonedEntity;
    }
    public function getContext(string $key){
        return $this->_context[$key];
    }
    public function withContext(string $key, $val) : LogEntity{
        $clonedEntity = clone $this;
        if($val === NULL){
            unset($clonedEntity->_context);
        }else{
            $clonedEntity->_context[$key] = $val;
        }
        return $clonedEntity;
    }
    public function withDeleteContext(string $key) : LogEntity{
        return $this->withContext($key,NULL);
    }
}