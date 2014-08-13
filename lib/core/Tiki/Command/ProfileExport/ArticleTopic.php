<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: ArticleTopic.php 48160 2013-10-24 14:16:58Z lphuberdeau $

namespace Tiki\Command\ProfileExport;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ArticleTopic extends ObjectWriter
{
	protected function configure()
	{
		$this
			->setName('profile:export:article-topic')
			->setDescription('Export an article topic definition')
			->addArgument(
				'topic',
				InputArgument::REQUIRED,
				'Topic ID'
			);

		parent::configure();
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$id = $input->getArgument('topic');

		$writer = $this->getProfileWriter($input);

		$result = \Tiki_Profile_InstallHandler_ArticleTopic::export($writer, $id);

		if ($result) {
			$writer->save();
		} else {
			$output->writeln("Topic not found: $id");
		}
	}
}
