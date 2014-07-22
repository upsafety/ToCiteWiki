<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: EmailAction.php 44485 2013-01-10 15:12:45Z lphuberdeau $

class Search_Action_EmailAction implements Search_Action_Action
{
	function getValues()
	{
		return array(
			'replyto' => false,
			'to+' => true,
			'cc+' => false,
			'bcc+' => false,
			'subject' => true,
			'content' => true,
		);
	}

	function validate(JitFilter $data)
	{
		return true;
	}

	function execute(JitFilter $data)
	{
		require_once 'lib/mail/maillib.php';

		try {
			$mail = tiki_get_admin_mail();

			if ($replyto = $data->replyto->email()) {
				$mail->setReplyTo($replyto);
			}

			foreach ($data->to->email() as $to) {
				$mail->addTo($this->stripNp($to));
			}

			foreach ($data->cc->email() as $cc) {
				$mail->addCc($this->stripNp($cc));
			}

			foreach ($data->bcc->email() as $bcc) {
				$mail->addBcc($this->stripNp($bcc));
			}

			$content = $this->parse($data->content->none());
			$subject = $this->parse($data->subject->text());

			$mail->setSubject(strip_tags($subject));
			$mail->setBodyHtml($content);

			$mail->send();

			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	private function parse($content)
	{
		$content = "~np~$content~/np~";

		$parserlib = TikiLib::lib('parser');

		$options = array(
			'protect_email' => false,
		);

		return trim($parserlib->parse_data($content, $options));
	}

	private function stripNp($content)
	{
		return str_replace(array('~np~', '~/np~'), '', $content);
	}
}

