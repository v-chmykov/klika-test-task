<?php

namespace Api\TracklistBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TrackRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TrackRepository extends EntityRepository
{
    /**
     * Returns all ordered artists
     *
     * @return array
     */
    public function findAllArtists()
    {
        $query = 'SELECT DISTINCT t.artist FROM ApiTracklistBundle:Track t ORDER BY t.artist';

        return $this->getEntityManager()
            ->createQuery($query)
            ->getResult();
    }

    /**
     * Returns all ordered genres
     *
     * @return array
     */
    public function findAllGenres()
    {
        $query = 'SELECT DISTINCT t.genre FROM ApiTracklistBundle:Track t ORDER BY t.genre';

        return $this->getEntityManager()
            ->createQuery($query)
            ->getResult();
    }

    /**
     * Returns all ordered years
     *
     * @return array
     */
    public function findAllYears()
    {
        $query = 'SELECT DISTINCT t.year FROM ApiTracklistBundle:Track t ORDER BY t.year DESC';

        return $this->getEntityManager()
            ->createQuery($query)
            ->getResult();
    }
}
