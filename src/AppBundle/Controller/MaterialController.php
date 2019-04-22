<?php
namespace AppBundle\Controller;
use DateTime;
use AppBundle\Entity\Material;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MaterialController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function firstPage()
    {    
        return $this->render('default/first.html.twig', [
            'pageTitle' => "Bienvenue"
        ]);
    }

    /**
     * @Route("/materials", name="index")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Material::class);
        $materialList = $repository->findAll();
        
        return $this->render('default/index.html.twig', [
            'materials' => $materialList,
            'pageTitle' => "Liste"
        ]);
    }

    /**
     * @Route("/materials/{id}", name="material_details")
     */
    public function materialData($id)
    {
        $repository = $this->getDoctrine()->getRepository(Material::class);
        $materialItem = $repository->find($id);
        $materialList = $repository->findAll();
        
        if ($materialItem) {
            return $this->render('default/material.html.twig', [
                'material' => $materialItem,
                'pageTitle' => $materialItem->getMaterialName()
            ]);
        } else {
            return $this->render('default/index.html.twig', [
                'materials' => $materialList,
                'pageTitle' => "Liste",
                'error' => "Le matériel que vous tentez d'accéder n'existe pas"
            ]);
        }
    }

    /**
     * @Route("/form/{id}", name="edition_form")
     */
    public function editionForm($id, Request $request)
    {   
        $repository = $this->getDoctrine()->getRepository(Material::class);
        $materialItem = $repository->find($id);
        $materialList = $repository->findAll();
        $material = new Material();

        if ($materialItem) {
            // Fill the inputs with current data
            $material->setMaterialName($materialItem->getMaterialName());
            $material->setMaterialQuantity($materialItem->getMaterialQuantity());
            $material->setMaterialPrice($materialItem->getMaterialPrice());
            $form = $this->createFormBuilder($material)
                ->add('materialName', TextType::class, ['label' => 'Nom du matériel'])
                ->add('materialQuantity', IntegerType::class, ['label' => 'Quantité'])
                ->add('materialPrice', NumberType::class, ['label' => 'Prix à l\'unité'])
                ->add('save', SubmitType::class, ['label' => 'Mettre à jour', 'attr' => ['class' => 'buttonLink']])
                ->getForm();

            $form->handleRequest($request);
        
            if ($form->isSubmitted() && $form->isValid()) {
                // Collect and set data input from the form
                $material = $form->getData();
                $materialItem->setMaterialName($material->getMaterialName());
                $materialItem->setMaterialQuantity($material->getMaterialQuantity());
                $materialItem->setMaterialPrice($material->getMaterialPrice());

                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute("index");
            }
            return $this->render('default/form.html.twig', [
                'form' => $form->createView(),
                'pageTitle' => "Éditer " . $materialItem->getMaterialName()
            ]);
        } else {
            return $this->render('default/index.html.twig', [
                'materials' => $materialList,
                'pageTitle' => "Liste",
                'error' => "Le matériel que vous tentez d'accéder n'existe pas"
            ]);
        }
    }

    /**
     * @Route("/remove/{id}", name="decrement")
     */
    public function decrement($id, Request $request)
    {   
        $repository = $this->getDoctrine()->getRepository(Material::class);
        $materialItem = $repository->find($id);
        $materialList = $repository->findAll();
        if ($materialItem) {
            $material = new Material();
            $currentQuantity = $materialItem->getMaterialQuantity();
            // Only decrement if quantity is greater than or equal 1, else do nothing
            if ($currentQuantity >= 1) {
                $materialItem->setMaterialQuantity($currentQuantity - 1);
                $this->getDoctrine()->getManager()->flush();
            } else {
                return $this->render('default/index.html.twig', [
                    'materials' => $materialList,
                    'pageTitle' => "Liste",
                    'error' => "Vous ne pouvez pas avoir un stock négatif"
                ]);
            }
            return $this->redirectToRoute("index");
        } else {
            return $this->render('default/index.html.twig', [
                'materials' => $materialList,
                'pageTitle' => "Liste",
                'error' => "Le matériel que vous tentez d'accéder n'existe pas"
            ]);
        }
    }

    /**
     * @Route("/generate", name="data_generation")
     */

    // This route is used to generate fake data. Call it to add 10 more entries to the list
    public function dataGeneration(ObjectManager $manager)
    {   
        $alphabet = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];

        for ($i = 0; $i < 10; $i++) {
            $material = new Material();
            $material->setMaterialName($alphabet[array_rand($alphabet, 1)] . "" . rand(1000,9999));
            $material->setMaterialPrice(rand(100, 10000) / 100);
            $material->setMaterialQuantity(rand(1, 10));
            $material->setMaterialCreatedAt(new \DateTime);
            $manager->persist($material);
        }
        
        $manager->flush();
        return $this->redirectToRoute("index");
    }
}