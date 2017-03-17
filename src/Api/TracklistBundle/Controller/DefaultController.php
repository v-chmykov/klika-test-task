<?php

namespace Api\TracklistBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package Api\TracklistBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * Default route
     *
     * @return Response
     */
    public function indexAction()
    {
        $m = $this->getDoctrine()->getManager();
        $songs = $m->getRepository('ApiTracklistBundle:Track')->findAll();
        $serializedEntity = $this->container->get('serializer')->serialize($songs, 'json');

        return new Response($serializedEntity);
    }

    /**
     * List of all songs
     *
     * @param Request $request
     * @return Response
     */
    public function songsAction(Request $request)
    {
        $criteria = $this->getCriteria($request);
        $orderBy = $this->getOrderBy($request);
        $limit = $request->query->getInt('limit', 10);
        $page = $request->query->getInt('page', 1);

        $m = $this->getDoctrine()->getManager();
        $songs = $m->getRepository('ApiTracklistBundle:Track')->findBy($criteria, $orderBy, $limit, $page - 1);
        $serializedEntity = $this->container->get('serializer')->serialize($songs, 'json');

        return new Response($serializedEntity);
    }

    /**
     * List of all artists
     *
     * @return Response
     */
    public function artistsAction()
    {
        $m = $this->getDoctrine()->getManager();
        $artists = array_map(function($item) {
            return $item['artist'];
        }, $m->getRepository('ApiTracklistBundle:Track')->findAllArtists());

        return new JsonResponse($artists);
    }

    /**
     * List of all available genres
     *
     * @return JsonResponse
     */
    public function genresAction()
    {
        $m = $this->getDoctrine()->getManager();
        $genres = array_map(function($item) {
            return $item['genre'];
        }, $m->getRepository('ApiTracklistBundle:Track')->findAllGenres());

        return new JsonResponse($genres);
    }

    /**
     * List of all available years
     *
     * @return JsonResponse
     */
    public function yearsAction()
    {
        $m = $this->getDoctrine()->getManager();
        $years = array_map(function($item) {
            return $item['year'];
        }, $m->getRepository('ApiTracklistBundle:Track')->findAllYears());

        return new JsonResponse($years);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function getCriteria(Request $request)
    {
        $filterBy = $request->query->get('filterBy', false);
        $filter = $request->query->get('filter');

        // Empty filter given
        if (false === $filterBy) {
            return [];
        }

        // Multiple parameters
        if (is_array($filterBy)) {
            $return = [];
            foreach($filterBy as $i => $key) {
                $return[$key] = $filter[$i];
            }

            return $return;
        }

        return [$filterBy => $filter];
    }

    /**
     * @param Request $request
     * @return array
     */
    private function getOrderBy(Request $request)
    {
        $sortBy = $request->query->get('sortBy', 'title');
        $order = strtoupper($request->query->get('order', 'ASC'));

        return [$sortBy => $order];
    }
}
