<?php

use Illuminate\Database\Seeder;

class UserBookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $faker;

    public function __construct(Faker\Generator $faker) {
        $this->faker = $faker;
    }
    
    public function run()
    {
        $users = App\User::all();
        $books = App\Book::lists('id');
        
        foreach($users as $user)
        {
            $user->books()->sync($this->faker->randomElements($books->toArray(), rand(0, count($books)/2)));
        }
        //
    }
}
