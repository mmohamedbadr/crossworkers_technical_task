<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Carmodel;
use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class SeedDefaultData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SystemData:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed Car Brands, models, categories';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = Config::get("data.brands");
        foreach ($data as $value) {
            $brand = Brand::where('name', $value['brand'])->first();
            if (!$brand) {
                $brand = new Brand();
                $brand->name = $value['brand'];
                $brand->save();
                foreach ($value['models'] as $modelName) {
                    $carModel = Carmodel::where('name', $modelName)->first();
                    if (!$carModel) {
                        $carModel = new Carmodel();
                        $carModel->name = $modelName;
                        $carModel->brand()->associate($brand);
                        $carModel->save();
                    }
                }

            }
        }
        $categories = Config::get("data.categories");
        $category= new Category();
        $category::insert($categories);
        echo "data seed success \n";
    }
}
