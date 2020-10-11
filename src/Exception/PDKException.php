<?php
namespace InteractivePlus\PDK2021Base\Exception;

class PDKException extends \Exception{
    private ?array $err_params = null;
    public function __construct(int $code = PDKErrCode::NO_ERROR, string $message = '', ?array $errParams = null, ?\Exception $previous = null){
        $this->err_params = $errParams;
        parent::__construct($message,$code,$previous);
    }

    /**
     * get error context/parameters
     * @return ?array an array containing the context(additional info) of the error
     */
    public function getErrorParams() : ?array{
        return $this->err_params;
    }

    /**
     * @see PDKException::toResponseJSON()
     */
    public function __toString() : string{
        return $this->toReponseJSON();
    }

    /**
     * turn this Exception instance into a JSON response string
     * @return string a JSON string containing error informations
     * JSON keys: errorCode[int], errorDescription[string], errorParams[array], errorFile[string], errorLine[int]
     */
    public function toReponseJSON() : string{
        $response_Array = array(
            'errorCode' => $this->getCode(),
            'errorDescription' => $this->getMessage(),
            'errorParams' => $this->getErrorParams(),
            'errorFile' => $this->getFile(),
            'errorLine' => $this->getLine()
        );
        return json_encode($response_Array);
    }
}