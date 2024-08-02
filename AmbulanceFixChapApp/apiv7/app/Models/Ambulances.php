namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'brand',
        'amblnc_number',
        'route',
        'price',
        'image',
    ];
}
