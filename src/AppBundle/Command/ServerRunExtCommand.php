<?php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\WebServerBundle\WebServer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Bundle\WebServerBundle\Command\ServerRunCommand;
use Symfony\Component\Process\Process;
use Composer\Script\Event;

class ServerRunExtCommand extends ServerRunCommand
{
	public function __construct($documentRoot = null, $environment = null)
	{
		parent::__construct($documentRoot, $environment);
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function configure()
	{
		$this
		->setDefinition(array(
				new InputArgument('addressport', InputArgument::OPTIONAL, 'The address to listen to (can be address:port, address, or port)'),
				new InputOption('docroot', 'd', InputOption::VALUE_REQUIRED, 'Document root, usually where your front controllers are stored'),
				new InputOption('router', 'r', InputOption::VALUE_REQUIRED, 'Path to custom router script'),
		))
		->setName('server:runext')
		->setDescription('Runs a local web server')
		->setHelp(<<<'EOF'
<info>%command.name%</info> runs a local web server: By default, the server
listens on <comment>127.0.0.1</> address and the port number is automatically selected
as the first free port starting from <comment>8000</>:
				
  <info>%command.full_name%</info>
				
This command blocks the console. If you want to run other commands, stop it by
pressing <comment>Control+C</> or use the non-blocking <comment>server:start</>
command instead.
				
Change the default address and port by passing them as an argument:
				
  <info>%command.full_name% 127.0.0.1:8080</info>
				
Use the <info>--docroot</info> option to change the default docroot directory:
				
  <info>%command.full_name% --docroot=htdocs/</info>
				
Specify your own router script via the <info>--router</info> option:
				
  <info>%command.full_name% --router=app/config/router.php</info>
				
See also: http://www.php.net/manual/en/features.commandline.webserver.php
EOF
				)
				;
	}
	
    protected function execute(InputInterface $input, OutputInterface $output)
    {
//     	$io = new SymfonyStyle($input, $output instanceof ConsoleOutputInterface ? $output->getErrorOutput() : $output);
    	
//     	// Esegue "npm run watch".
//     	$cmd = 'cd "' . escapeshellarg(__DIR__ . '/../Resources/assets'). '" && npm run watch';
//     	$process = new Process($cmd, null, null, null, 300);
//     	$process->run(function ($type, $buffer) use ($output) {
//     		// $event->getIO()->write($buffer, false);
//     		$output->write($buffer, false, OutputInterface::OUTPUT_RAW);
//     	});
    	
//     	if (!$process->isSuccessful()) {
//     		$io->error(sprintf("An error occurred when executing the \"%s\" command:\n\n%s\n\n%s", escapeshellarg($cmd), self::removeDecoration($process->getOutput()), self::removeDecoration($process->getErrorOutput())));    	
//     	}
 
    	//$io->success(sprintf('Server listening on http://%s', $config->getAddress()));
    			
    	$exitCode = parent::execute($input, $output);
    	
    	return $exitCode;
    }
}