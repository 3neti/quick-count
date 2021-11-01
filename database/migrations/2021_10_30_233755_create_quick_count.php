<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuickCount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("DROP VIEW IF EXISTS `quick-count`");
        DB::statement(
            "CREATE VIEW `quick-count` AS
select candidates.code as candidate, stations.cluster, stations.barangay, stations.municity, stations.district, stations.province, stations.region, stations.island, sum(poll_items.votes) as votes from poll_items
join candidates on candidates.id = poll_items.candidate_id
join polls on polls.id = poll_items.poll_id
join stations on stations.id = polls.station_id
group by 1, 2, 3, 4, 5, 6, 7, 8
order by 3 desc");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW `quick-count`");
    }
}
