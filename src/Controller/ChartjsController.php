<?php

namespace App\Controller;

use App\Repository\reservationpackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ChartjsController extends AbstractController
{
    /**
     * @Route("/chartjs", name="app_chartjs")
     */
    public function index(reservationpackRepository $reservationpackRepository, ChartBuilderInterface $chartBuilder): Response
    {

        $reservationpacks = $reservationpackRepository->findAll();

        $labels = [];
        $data = [];

        foreach ($reservationpacks as $reservationpack) {
            $labels[] = $reservationpack->getDate();
            $data[]=$reservationpack->getPrixrespack();
        }

        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);

        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'is3D' => true,
                    'data' =>$data,
                ],
            ],
        ]);

        $chart->setOptions([
          
        ]);
        return $this->render('chartjs/index.html.twig', [
            'controller_name' => 'ChartjsController',
            'chart' => $chart
        ]);
    }
}
