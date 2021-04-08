<?php
use Illuminate\Database\Seeder;
use Survey\Models\Survey;
use Survey\Models\Field;

class FieldsSortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $forms = Survey::get();

        foreach($forms as $form){
            $count = 1;
            foreach($form->fields as $field){
                $field = Field::find($field->id);
                $field->sort = $count;
                $field->save();

                $count++;
            }
        }
    }
}
