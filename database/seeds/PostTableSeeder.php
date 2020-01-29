<?php

use Illuminate\Database\Seeder;
use App\Post;




class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $post= new \App\Post([
            'title'=>'Learning Laravel',
            'content'=>'Some other content'
        ]);
        $post->save();
        
         $post= new \App\Post([
            'title'=>'Something else',
            'content'=>'Some other content'
        ]);
        $post->save();
        
        /*
        
        
         // Let's truncate our existing records to start from scratch.
        Post::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        
         
        
        
        for ($i = 0; $i < 3; $i++) {
            Post::create([
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'user_id' => auth()->id
            ]);
         
 
            
            
        }
        
         */
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    }
}
