<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Moneyrequest;
use App\Models\Payout;
use App\Models\Qrpayment;
use App\Models\SingleCharge;
use App\Models\SingleChargeOrder;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CurrencySeeder::class,
            GatewaySeeder::class,
            OptionSeeder::class,
            CategorySeeder::class,
            BankSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            MediaSeeder::class,
            MenuSeeder::class,
            TermSeeder::class,
            KycSeeder::class,
           
        ]);

        //if you want to demo data just uncomment the seeders
        if (config('app.env') == 'local'){
            // ProductCategorySeeder::class,
            // StoreFrontSeeder::class,
            // ProductSeeder::class,
            // ProductStoreSeeder::class,
            // Transaction::factory(50)->create();
            // Invoice::factory(50)->create();
            // Qrpayment::factory(50)->create();
            // SingleCharge::factory()->create();
            // Donation::factory(10)->hasOrders(10)->create();
            // Website::factory(10)->hasOrders(10)->create();
            // Transfer::factory(100)->create();
            // Moneyrequest::factory(100)->create();
            // Payout::factory(100)->create();

            // SingleCharge::all()->map(fn($charge) => SingleChargeOrder::factory(10)->create(['singlecharge_id' => $charge->id]));
            // Invoice::all()->map(fn($invoice) => InvoiceItem::factory(10)->create(['invoice_id' => $invoice->id]));
        }

        \Artisan::call('cache:clear');
    }
}
