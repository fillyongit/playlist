<?php
namespace AppBundle\Composer;

use Symfony\Component\Process\Process;
use Composer\Script\Event;
use Composer\IO\IOInterface;

class ScriptHandler
{
	public static function appAssetsInstall(Event $event)
	{
		$appAssetsDir = './src/AppBundle/Resources/assets';
		
		if (null === $appAssetsDir) {
			return;
		}
		
		$cmd = escapeshellarg('npm --prefix ' . $appAssetsDir . ' install ' . $appAssetsDir);
		$process = new Process($cmd, null, null, null, 300);
		$process->run(function ($type, $buffer) use ($event) { $event->getIO()->write($buffer, false); });
		if (!$process->isSuccessful()) {
			throw new \RuntimeException(sprintf("An error occurred when executing the \"%s\" command:\n\n%s\n\n%s", escapeshellarg($cmd), self::removeDecoration($process->getOutput()), self::removeDecoration($process->getErrorOutput())));
		}
	}

	private static function removeDecoration($string)
	{
		return preg_replace("/\033\[[^m]*m/", '', $string);
	}
}