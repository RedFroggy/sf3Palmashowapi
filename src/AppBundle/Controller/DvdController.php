<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Dvd;

use AppBundle\Form\DvdType;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations;

/**
 * Class DvdController
 * @package AppBundle\Controller
 */
class DvdController extends Controller
{
    /**
     * Get list of Dvds
     *
     * @ApiDoc(
     *   resource = true,
     *   output = "\AppBundle\Entity\Dvd[]",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @return \AppBundle\Entity\Dvd[]|array
     */
    public function getDvdsAction(Request $request)
    {
        $limit = $request->query->get("limit",false);
        $dvds = $this->getDoctrine()->getRepository('AppBundle:Dvd')->findAllInArrayResult($limit);
        return $dvds;
    }

    /**
     * Read an dvd
     * @ApiDoc(
     *      resource=true,
     *      output="\AppBundle\Entity\Dvd",
     *      statusCodes = {
     *          200 = "Returned when successful",
     *          404 = "Returned when the note is not found"
     *      }
     * )

     *
     * @param $id
     * @return Dvd
     */
    public function getDvdAction($id)
    {
        $dvd = $this->getDoctrine()->getRepository('AppBundle:Dvd')->findInArrayResult($id);
        if (!is_array($dvd)) {
            throw $this->createNotFoundException();
        }

        return $dvd;
    }

    /**
     * Create dvd
     * @ApiDoc(
     *      input="\AppBundle\Form\DvdType",
     *      output="\AppBundle\Entity\Dvd",
     * )
     * @param Request $request
     * @return mixed|\Symfony\Component\Form\Form
     */
    public function postDvdAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\DvdType');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dvd = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($dvd);
            $em->flush();

            return $dvd;
        }

        return $form;
    }

    /**
     * Update dvd
     * @ApiDoc
     * @param Request $request
     * @param $id
     * @return Dvd|\Symfony\Component\Form\Form
     */
    public function putDvdAction(Request $request, $id)
    {
        $dvd = $this->getDoctrine()->getRepository('AppBundle:Dvd')->findOneById($id);
        $form = $this->createForm('AppBundle\Form\DvdType', $dvd, array('method' => 'PUT'));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->merge($dvd);
            $em->flush();

            return $dvd;
        }
        return $form;
    }

    /**
     * Delete dvd
     * @ApiDoc
     * @param string $slug title's slug
     */
    public function deleteDvdAction($id)
    {
        $resource = $this->getDoctrine()->getRepository('AppBundle:Dvd')->findOneById($id);
        if (!$resource) {
            throw $this->createNotFoundException("dvd not found.");
        }
        $this->getDoctrine()->getManager()->remove($resource);
        $this->getDoctrine()->getManager()->flush();
    }
}
