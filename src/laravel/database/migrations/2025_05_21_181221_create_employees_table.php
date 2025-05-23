

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('employees', function (Blueprint $table) {
    //         $table->id();
    //         $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
    //         $table->string('name');
    //         $table->string('email')->unique();
    //         $table->string('password');
    //         $table->string('address')->nullable();
    //         $table->string('city')->nullable();
    //         $table->string('cpf')->unique();
    //         $table->string('rg')->nullable();
    //         $table->date('dt_birth')->nullable();
    //         $table->string('phone')->nullable();
    //         $table->integer('role_id')->nullable();
    //         $table->integer('job_id')->nullable();
    //         $table->string('origin_user')->nullable();
    //         $table->string('last_user')->nullable();
    //         $table->timestamps();
    //     });
    // }

    /**
     * Reverse the migrations.
     */
    // public function down(): void
    // {
        // Schema::dropIfExists('employees');
    // }
// };
