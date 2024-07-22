<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Validator;

abstract class ItemSeeder extends Seeder {

    protected $items = array();

    public function run(): void {
        $this->command->info('===========================   DATA  SEEDER   ===========================');
        $this->command->info('Seeding data from "' . $this::class . '"');
        $this->command->info('========================================================================');
        $this->command->newLine();

        foreach ($this->items as $key => $item) {

            $validator = validator(
                $item,
                $this->rules(),
                $this->messages(),
                $this->attributes()
            );
    
            if ($validator->fails()) {
                $this->command->fail("Validation fails for item $key!" . $validator->errors());
            }

            $this->persit($validator);
            
        }
        $this->command->newLine();
        $this->command->info('Successfully seeded!');
        $this->command->info('========================================================================');
        $this->command->newLine();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function rules(): array
    {
        return [];
    }
    
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    protected function messages()
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    protected function attributes()
    {
        return [];
    }

    /**
     * 
     */
    protected function persit(\Illuminate\Contracts\Validation\Validator $validator): void {
    }

}