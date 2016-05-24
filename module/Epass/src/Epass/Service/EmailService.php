<?php

namespace Epass\Service;

use Zend\Mail\Message,
    Zend\Mime\Message as MimeMessage,
    Zend\Mime\Part as MimePart,
    Zend\Mail\Transport\Smtp,
    Zend\Mail\Transport\SmtpOptions,
    Zend\View\Resolver,
    Zend\View\Renderer\PhpRenderer,
    Zend\View\Model\ViewModel;

class EmailService
{

    protected $config;
    protected $view;

    protected $deniedEmail = false;

    public function setConfig($value)
    {
        $this->config = $value;
    }

    private function deniedEmail($emails)
    {
        $emailsAllowed = array();
        if(isset($this->config['list.allowed']['enabled'])
            && $this->config['list.allowed']['enabled'] != true){
                return $emails;
            }

        if (!is_array($emails)) {
            $emails = explode(',', $emails);
        }

        foreach ($emails as $key => $value) {
            if ($value !== '') {
                if ($this->isDomainAllowed($value)) {
                    $emailsAllowed[] = $value;
                }
                if ($this->isEmailAllowed($value)) {
                    $emailsAllowed[] = $value;
                }
            }
        }

        return implode(',', $emailsAllowed);

    }

    private function isEmailAllowed($email)
    {
        $config  = $this->config['list.allowed'];
        $emailsAllowed  = $config['emails'];

        return in_array($email, $emailsAllowed);
    }

    private function isDomainAllowed($email)
    {
        $config  = $this->config['list.allowed'];
        $domains  = $config['domains'];
        $response = explode('@', $email);
        if (!is_array($response)) {
            return false;
        }
        $domain = isset($response[1]) ? $response[1] : false;

        return in_array($domain, $domains);
    }

    public function enviarMail($asunto, $email, $template, $data = array(),
        $copias = array(), $desdeEmail = NULL, $desdeNombre = NULL,
        $responderEmail = NULL, $responderNombre = NULL)
    {
        $email = $this->deniedEmail($email);

        if (!$email) {
            return true;
        }

        if (!is_array($email)) {
            $email = explode(',', $email);
        }

        $text = new MimePart('');
        $text->type = \Zend\Mime\Mime::TYPE_HTML; //"text/plain";

        $renderer = new PhpRenderer();
        $resolver = new Resolver\TemplateMapResolver();
        $resolver->setMap(array(
            'mailTemplate' => $template
        ));
        $renderer->setResolver($resolver);
        $vista = new ViewModel($data);
        $vista->setTemplate('mailTemplate');
        $mensaje = $renderer->render($vista);

        $html = new MimePart($mensaje);
        $html->type = \Zend\Mime\Mime::TYPE_HTML;

        $body = new MimeMessage();
        $body->setParts([/*$text,*/$html]);

        $message = new Message();
        $message->setEncoding("UTF-8")
            ->addTo($email)
            ->setSubject($asunto)
            ->setBody($body)
            ->getHeaders()->get('content-type')->setType(\Zend\Mime\Mime::TYPE_HTML);

        if (is_array($copias)) {
            foreach ($copias as $k => $email) {
                $add = $k == 'cc' ? 'addCc': 'addBcc';
                $message->$add($email);
            }
        }

        $message->setFrom($this->config['fromEmail'], $this->config['fromName']);

        if (!is_null($desdeEmail) && !is_null($desdeNombre)) {

            $message->setReplyTo($desdeEmail, $desdeNombre);
            $message->setFrom($this->config['fromEmail'], $desdeNombre);

        }

        if (!is_null($responderEmail) && !is_null($responderNombre)) {
            $message->setReplyTo($responderEmail, $responderNombre);
            $message->setSender($responderEmail, $responderNombre);
        }

        $transport = new Smtp();
        $transport->setOptions(new SmtpOptions($this->config['transport']['options']));

        try {

        $transport->send($message);

        return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function enviarMailException($asunto, $email, $template,
        $data = array(), $copias = array(), $desdeEmail = NULL,
        $desdeNombre = NULL, $responderEmail = NULL, $responderNombre = NULL)
    {
        $email = $this->deniedEmail($email);

        if (!$email) {
            return true;
        }

        if (!is_array($email)) {
            $email = explode(',', $email);
        }

        $text = new MimePart('');
        $text->type = \Zend\Mime\Mime::TYPE_HTML; //"text/plain";

        $renderer = new PhpRenderer();
        $resolver = new Resolver\TemplateMapResolver();
        $resolver->setMap(array(
            'mailTemplate' => $template
        ));
        $renderer->setResolver($resolver);
        $vista = new ViewModel($data);
        $vista->setTemplate('mailTemplate');
        $mensaje = $renderer->render($vista);

        $html = new MimePart($mensaje);
        $html->type = "text/html";

        $body = new MimeMessage();
        $body->setParts([/*$text,*/$html]);

        $message = new Message();
        $message->setEncoding("UTF-8")
            ->addTo($email)
            ->setSubject($asunto)
            ->setBody($body)
            ->getHeaders()->get('content-type')->setType(\Zend\Mime\Mime::TYPE_HTML);

        if (is_array($copias)) {
            foreach ($copias as $k => $email) {
                $add = $k == 'cc' ? 'addCc': 'addBcc';
                $message->$add($email);
            }
        }

        if (!is_null($desdeEmail) && !is_null($desdeNombre)) {
            $message->setFrom($desdeEmail, $desdeNombre);
        } else {
            $message->setFrom($this->config['fromEmail'],
                $this->config['fromName']);
        }

        if (!is_null($responderEmail) && !is_null($responderNombre)) {
            $message->setReplyTo($responderEmail, $responderNombre);
        }

        $transport = new Smtp();
        $transport->setOptions(new SmtpOptions($this->config['transport']['options']));

        $transport->send($message);
    }

    public function enviarMailExceptionNoTemplate($asunto, $email, $mensaje,
        $copias = array(), $desdeEmail = NULL, $desdeNombre = NULL,
        $responderEmail = NULL, $responderNombre = NULL)
    {
        $email = $this->deniedEmail($email);

        if (!$email) {
            return true;
        }

        if (!is_array($email)) {
            $email = explode(',', $email);
        }

        $text = new MimePart('');
        $text->type = \Zend\Mime\Mime::TYPE_HTML; //"text/plain";

        $html = new MimePart($mensaje);
        $html->type = \Zend\Mime\Mime::TYPE_HTML;
        //$html->disposition = \Zend\Mime\Mime::DISPOSITION_INLINE;
        //$html->encoding = \Zend\Mime\Mime::ENCODING_QUOTEDPRINTABLE;
        //$html->charset = 'utf-8';

        $body = new MimeMessage();
        $body->setParts([/*$text,*/$html]);

        $message = new Message();
        $message->setEncoding("UTF-8") //Content-Transfer-Encoding: quoted-printable
            ->addTo($email)
            ->setSubject($asunto)
            ->setBody($body)
            ->getHeaders()->get('content-type')->setType(\Zend\Mime\Mime::TYPE_HTML);

        if (is_array($copias)) {
            foreach ($copias as $k => $email) {
                $add = $k == 'cc' ? 'addCc': 'addBcc';
                $message->$add($email);
            }
        }

        if (!is_null($desdeEmail) && !is_null($desdeNombre)) {
            $message->setFrom($desdeEmail, $desdeNombre);
        } else {
            $message->setFrom($this->config['fromEmail'],
                $this->config['fromName']);
        }

        if (!is_null($responderEmail) && !is_null($responderNombre)) {
            $message->setReplyTo($responderEmail, $responderNombre);
        }

        $transport = new Smtp();
        $transport->setOptions(new SmtpOptions($this->config['transport']['options']));

        $transport->send($message);
    }
    
    public function recibirMail($asunto, $fromEmail, $template, $data) {
        $fromEmail = $this->deniedEmail($fromEmail);

        if (!$fromEmail) {
            return true;
        }
        
        $text = new MimePart('');
        $text->type = \Zend\Mime\Mime::TYPE_HTML; //"text/plain";

        $renderer = new PhpRenderer();
        $resolver = new Resolver\TemplateMapResolver();
        $resolver->setMap(array(
            'mailTemplate' => $template
        ));
        $renderer->setResolver($resolver);
        $vista = new ViewModel($data);
        $vista->setTemplate('mailTemplate');
        $mensaje = $renderer->render($vista);

        $html = new MimePart($mensaje);
        $html->type = \Zend\Mime\Mime::TYPE_HTML;

        $body = new MimeMessage();
        $body->setParts([/*$text,*/$html]);
        
        $message = new Message();
        $message->setEncoding("UTF-8")
            ->addTo($this->config['toEmailAdmin'])
            ->setSubject($asunto)
            ->setBody($body)
            ->getHeaders()->get('content-type')->setType(\Zend\Mime\Mime::TYPE_HTML);
        
        $message->setFrom($fromEmail);
        
        $transport = new Smtp();
        $transport->setOptions(new SmtpOptions($this->config['transport']['options']));

        $transport->send($message);
    }
}
