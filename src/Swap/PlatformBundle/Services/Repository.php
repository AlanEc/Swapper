<?php
namespace Swap\PlatformBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Repository {

	private $doctrine;

	public function __construct($doctrine)
	{
		$this->doctrine = $doctrine;
	}

	public function get($repositoryName)
	{  
		$repository = $this->doctrine
		->getRepository($repositoryName)
		;
		return $repository;
	}
}