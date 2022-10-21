<?php

namespace App\Console\Commands;
use App\Http\Controllers\tenantController;

use Illuminate\Console\Command;

class crear_tenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:crear_tenant {tenant_nombre : nombre como se usara}  {tenant_alias : alias identificador}  {tenant_cliente : nombre del cliente a quien representa}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'crear nuevo tenant en la base de datos';

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
        (new tenantController())->create(
            $this->arguments()["tenant_nombre"],
            $this->arguments()["tenant_alias"],
            $this->arguments()["tenant_cliente"]
        );
        return 0;
    }
}
