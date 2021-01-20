<?php
namespace InteractivePlus\PDK2021Core\Communication\CommunicationContents\Implementions\EmailTemplateContent;
interface UserSystemLinkProvider{
    public function verifyEmailLink(?string $locale = null) : string;
    public function forgotPasswordLink(?string $locale = null) : string;
    public function changeEmailLink(?string $locale = null) : string;
    public function changePhoneLink(?string $locale = null) : string;
}