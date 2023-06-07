<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
            [
                "title" => "Sito Web E-commerce",
                "description" => "Sviluppo di un sito web di e-commerce con funzionalità di acquisto, gestione del carrello e pagamento online.",
                "image" => "https://www.rivoluzionecreativa.com/wp-content/uploads/2019/08/sito-web-e-commerce.jpg"
            ],
            [
                "title" => "Applicazione di Gestione delle Attività",
                "description" => "Creazione di un'applicazione web per la gestione delle attività quotidiane, inclusa la pianificazione, il tracciamento del tempo e la collaborazione.",
                "image" => "https://th.bing.com/th/id/OIP.gAY4bMgu6yaTY0h1Pjnu5QHaEK?pid=ImgDet&rs=1"
            ]
        ];

        foreach ($projects as $project) {
            $newProject = new Project();
            $newProject->title = $project['title'];
            $newProject->description = $project['description'];
            $newProject->image = $project['image'];
            $newProject->slug = Str::slug($project['title'], '-');
            $newProject->save();
        }
    }
}
