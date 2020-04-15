<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [[
            'id'         => '1',
            'title'      => 'Acesso a administração do sistema',
            'nature'     => 'Administração de sistema',
            'created_at' => '2019-04-15 19:14:42',
            'updated_at' => '2019-04-15 19:14:42',
        ],
            [
                'id'         => '2',
                'title'      => 'Pode criar permissões',
                'nature'     => 'Administração de permissões',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '3',
                'title'      => 'Pode editar permissões',
                'nature'     => 'Administração de permissões',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '4',
                'title'      => 'Pode ver permissões',
                'nature'     => 'Administração de permissões',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '5',
                'title'      => 'Pode excluir permissões',
                'nature'     => 'Administração de permissões',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '6',
                'title'      => 'Pode acessar permissões',
                'nature'     => 'Administração de permissões',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '7',
                'title'      => 'Pode criar funções',
                'nature'     => 'Administração de funções',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '8',
                'title'      => 'Pode editar funções',
                'nature'     => 'Administração de funções',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '9',
                'title'      => 'Pode ver funções',
                'nature'     => 'Administração de funções',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '10',
                'title'      => 'Pode excluir funções',
                'nature'     => 'Administração de funções',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '11',
                'title'      => 'Pode acessar funções',
                'nature'     => 'Administração de funções',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '12',
                'title'      => 'Pode criar usuário',
                'nature'     => 'Administração de usuários',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '13',
                'title'      => 'Pode editar usuário',
                'nature'     => 'Administração de usuários',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '14',
                'title'      => 'Pode ver usuários',
                'nature'     => 'Administração de usuários',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '15',
                'title'      => 'Pode excluir usuário',
                'nature'     => 'Administração de usuários',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '16',
                'title'      => 'Pode acessar usuários',
                'nature'     => 'Administração de usuários',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '17',
                'title'      => 'Pode criar número',
                'nature'     => 'Administração de chamadas',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '18',
                'title'      => 'Pode acessar números',
                'nature'     => 'Administração de chamadas',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '19',
                'title'      => 'Pode editar números',
                'nature'     => 'Administração de chamadas',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '20',
                'title'      => 'Pode ver detalhes de um número',
                'nature'     => 'Administração de chamadas',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '21',
                'title'      => 'Pode excluir números',
                'nature'     => 'Administração de chamadas',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '22',
                'title'      => 'Pode chamar número PIS',
                'nature'     => 'Administração de chamadas',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '23',
                'title'      => 'Pode aprovar / reprovar números PIS',
                'nature'     => 'Administração de chamadas',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '24',
                'title'      => 'Pode excluir números PIS',
                'nature'     => 'Administração de chamadas',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '25',
                'title'      => 'Pode acessar gerenciamento de chamadas (PIS)',
                'nature'     => 'Administração de chamadas',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '26',
                'title'      => 'Pode acessar Administração de guichês',
                'nature'     => 'Administração de guichês',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '27',
                'title'      => 'Pode criar guichê',
                'nature'     => 'Administração de guichês',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '28',
                'title'      => 'Pode alterar guichê',
                'nature'     => 'Administração de guichês',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '29',
                'title'      => 'Pode excluir guichê',
                'nature'     => 'Administração de guichês',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '30',
                'title'      => 'Pode acessar gerenciamento de chamadas (PE)',
                'nature'     => 'Administração de chamadas',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '31',
                'title'      => 'Pode aprovar / reprovar números PE',
                'nature'     => 'Administração de chamadas',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '32',
                'title'      => 'Pode chamar número PE',
                'nature'     => 'Administração de chamadas',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '33',
                'title'      => 'Pode acessar dispensados',
                'nature'     => 'Controle de dispensados',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '34',
                'title'      => 'Pode acessar selecionados',
                'nature'     => 'Controle de selecionados',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '35',
                'title'      => 'Pode confirmar um número',
                'nature'     => 'Administração de chamadas',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '36',
                'title'      => 'Pode acessar administração de painéis',
                'nature'     => 'Administração de painéis',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '37',
                'title'      => 'Pode criar painel',
                'nature'     => 'Administração de painéis',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '38',
                'title'      => 'Pode excluir painel',
                'nature'     => 'Administração de painéis',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ],
            [
                'id'         => '39',
                'title'      => 'Pode editar painel',
                'nature'     => 'Administração de painéis',
                'created_at' => '2019-04-15 19:14:42',
                'updated_at' => '2019-04-15 19:14:42',
            ]





        ];

        Permission::insert($permissions);
    }
}


