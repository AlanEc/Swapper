<?php

namespace Swap\PlatformBundle\Repository;

/**
 * ServiceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ServiceRepository extends \Doctrine\ORM\EntityRepository
{
	public function swapRecovery($data) {
		$qb = $this->createQueryBuilder('m');

		$qb
		->where('m.parentId is null')
		->andWhere($qb->expr()->orX(
		$qb->expr()->eq('m.author', $idUser),
		$qb->expr()->eq('m.recipient', $idUser)
		))
		;

		return $qb
		->getQuery()
		->getResult();
	}

	public function serviceRecovery($data) {
		$qb = $this->createQueryBuilder('m');

		$qb
		->andWhere('m.lattitude BETWEEN :lattitude1 AND :lattitude2')
		->setParameter('lattitude1', $data[0])  
		->setParameter('lattitude2', $data[3])
		;

		return $qb;
	
	}

	public function swapsByAdress($adresse)
    {
		$qb = $this->createQueryBuilder('m');

		$qb
		->where('m.adresse = :adresse')
		->setParameter('adresse', $adresse)
		;

		return $qb
		->getQuery()
		->getResult();
	}

	public function swapsByCoord($coord)
    {
		$qb = $this->createQueryBuilder('m');

		$qb
		->where('m.longitude BETWEEN :swlng AND :nelng')
		->setParameter('swlng', $coord['swlng'])
		->setParameter('nelng', $coord['nelng'])
		->andWhere('m.lattitude BETWEEN :swlat AND :nelat')
		->setParameter('swlat', $coord['swlat'])
		->setParameter('nelat', $coord['nelat'])
		;

		return $qb
		->getQuery()
		->getResult();
	}

	// public function whereCurrentYear(QueryBuilder $qb)
	// {
	// 	$qb
	// 	->andWhere('a.date BETWEEN :start AND :end')
	// 	->setParameter('start', new \Datetime(date('Y').'-01-01'))  // Date entre le 1er janvier de cette année
	// 	->setParameter('end',   new \Datetime(date('Y').'-12-31'))  // Et le 31 décembre de cette année
	// 	;
	// }
}
