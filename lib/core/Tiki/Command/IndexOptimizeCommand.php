<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: IndexOptimizeCommand.php 47202 2013-08-22 10:29:57Z changi67 $

namespace Tiki\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class IndexOptimizeCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('index:optimize')
            ->setDescription('Optimize the unified search index');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
		$unifiedsearchlib = \TikiLib::lib('unifiedsearch');

		$output->writeln('Started optimizing index...');

		$unifiedsearchlib->getIndex()->optimize();

		$output->writeln('Optimizing index done');
    }
}
