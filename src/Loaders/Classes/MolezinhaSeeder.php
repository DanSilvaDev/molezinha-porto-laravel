<?php
namespace Molezinha\Loaders\Classes;

use Molezinha\Abstracts\Seeders\Seeder;
use Molezinha\Loaders\SeederLoaderTrait;

class MolezinhaSeeder extends Seeder
{
    use SeederLoaderTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->runLoadingSeeders();
    }
}
