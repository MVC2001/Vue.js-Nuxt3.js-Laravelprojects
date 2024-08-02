use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbulancesTable extends Migration
{
    public function up()
    {
        Schema::create('ambulances', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('brand');
            $table->string('amblnc_number');
            $table->string('route');
            $table->decimal('price', 8, 2);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ambulances');
    }
}
