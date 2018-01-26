<?php
namespace AppBundle\Composer;

use Symfony\Component\Process\Process;
use Composer\Script\Event;
use Composer\IO\IOInterface;

class ScriptHandler
{
	private $io;
	
	public function __construct(IOInterface $io)
	{
		$this->io = $io;
	}
	
	public static function appAssetsInstall(Event $event)
	{
		$this->io->write(sprintf('<info>Sto per installare i moduli node necessari...</info>', $action, $realFile));
		
		$appAssetsDir = 'src/AppBundle/Resources/assets';
		
		if (null === $appAssetsDir) {
			return;
		}
		
		$cmd = escapeshellarg('npm --prefix ' . $appAssetsDir . ' install ' . $appAssetsDi);
		$process = new Process($cmd, null, null, null, $timeout);
		$process->run(function ($type, $buffer) use ($event) { $event->getIO()->write($buffer, false); });
		if (!$process->isSuccessful()) {
			throw new \RuntimeException(sprintf("An error occurred when executing the \"%s\" command:\n\n%s\n\n%s", escapeshellarg($cmd), self::removeDecoration($process->getOutput()), self::removeDecoration($process->getErrorOutput())));
		}
	}
}