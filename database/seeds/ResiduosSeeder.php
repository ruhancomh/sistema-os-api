<?php

use Illuminate\Database\Seeder;

class ResiduosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            [
                'id' => 1,
                'grupo' => 'Oleo usado',
                'codigo' => 'F130',
                'residuo_classes_id' => 1,
                'codigo_ibama' => '13 02 01',
                'descricao' => '(*) Óleos de motores, transmissões e lubrificação usados ou contaminados –',
            ],
            [
                'id' => 2,
                'grupo' => 'Borra de oleo',
                'codigo' => 'F099',
                'residuo_classes_id' => 1,
                'codigo_ibama' => '13 05 02',
                'descricao' => '(*) Lodo proveniente dos separadores óleo/água – ',
            ],
            [
                'id' => 3,
                'grupo' => 'AGUA COM OLEO',
                'codigo' => 'F530',
                'residuo_classes_id' => 1,
                'codigo_ibama' => '13 05 07',
                'descricao' => '(*) Água com óleo proveniente dos separadores óleo/água – ',
            ],
            [
                'id' => 4,
                'grupo' => 'Solidos Contaminados (Trapos, Filtros, EPIs)',
                'codigo' => 'F099',
                'residuo_classes_id' => 1,
                'codigo_ibama' => '15 02 02',
                'descricao' => '(*) Absorventes, materiais filtrantes (incluindo filtros de óleo não anteriormente especificados), panos de limpeza e vestuário de proteção, contaminados por substâncias perigosas – ',
            ],
            [
                'id' => 5,
                'grupo' => 'PILHAS E BATERIAIS',
                'codigo' => 'D099',
                'residuo_classes_id' => 1,
                'codigo_ibama' => '16 06 05',
                'descricao' => 'Outras pilhas, baterias e acumuladores – ',
            ],
            [
                'id' => 6,
                'grupo' => 'AMIANTO',
                'codigo' => 'F041',
                'residuo_classes_id' => 1,
                'codigo_ibama' => '17 06 05',
                'descricao' => '(*) Materiais de construção contendo amianto (por exemplo, telhas, tubos, etc.)  – ',
            ],
            [
                'id' => 7,
                'grupo' => 'Lampadas',
                'codigo' => 'F044',
                'residuo_classes_id' => 1,
                'codigo_ibama' => '20 01 21',
                'descricao' => '(*) Lâmpadas fluorescentes, de vapor de sódio e mercúrio e de luz mista – ',
            ],
            [
                'id' => 8,
                'grupo' => 'Eletronicos',
                'codigo' => 'D099',
                'residuo_classes_id' => 1,
                'codigo_ibama' => '20 01 23',
                'descricao' => '(*) Produtos eletroeletrônicos fora de uso contendo clorofluorcarbonetos – ',
            ],
            [
                'id' => 9,
                'grupo' => 'RESÍDUOS DE TINTA',
                'codigo' => 'F099',
                'residuo_classes_id' => 1,
                'codigo_ibama' => '20 01 27',
                'descricao' => '(*) Tintas, produtos adesivos, colas e resinas contendo substâncias perigosas – ',
            ],
            [
                'id' => 10,
                'grupo' => 'Pilhas e baterias',
                'codigo' => 'D099',
                'residuo_classes_id' => 1,
                'codigo_ibama' => '20 01 33',
                'descricao' => '(*) Pilhas e acumuladores abrangidos em 16 06 01, 16 06 02 ou 16 06 03 e pilhas e acumuladores não separados contendo essas pilhas ou acumuladores – ',
            ],
            [
                'id' => 11,
                'grupo' => 'Pilhas e baterias',
                'codigo' => 'D099',
                'residuo_classes_id' => 1,
                'codigo_ibama' => '20 01 34',
                'descricao' => 'Pilhas e acumuladores não abrangidos em 20 01 33 – ',
            ],
            [
                'id' => 12,
                'grupo' => 'Eletronicos',
                'codigo' => 'D099',
                'residuo_classes_id' => 1,
                'codigo_ibama' => '20 01 35',
                'descricao' => '(*) Produtos eletroeletrônicos e seus componentes fora de uso não abrangido em 20 01 21 ou 20 01 23 contendo componentes perigosos ([vi]) – ',
            ],
            [
                'id' => 13,
                'grupo' => 'Lixo Orgânico',
                'codigo' => 'A002',
                'residuo_classes_id' => 2,
                'codigo_ibama' => '20 01 08',
                'descricao' => 'Resíduos biodegradáveis de cozinhas e cantinas – ',
            ],
            [
                'id' => 14,
                'grupo' => 'oleo de cozinha',
                'codigo' => 'A030',
                'residuo_classes_id' => 2,
                'codigo_ibama' => '20 01 25',
                'descricao' => 'Óleos e gorduras alimentares – ',
            ],
            [
                'id' => 15,
                'grupo' => 'Lixo Comum',
                'codigo' => 'A002',
                'residuo_classes_id' => 2,
                'codigo_ibama' => '20 03 01',
                'descricao' => 'Outros resíduos urbanos e equiparados, incluindo misturas de resíduos – ',
            ],
            [
                'id' => 16,
                'grupo' => 'LODO DE FOSSA',
                'codigo' => 'A022',
                'residuo_classes_id' => 2,
                'codigo_ibama' => '20 03 04',
                'descricao' => 'Lodos de fossas sépticas – ',
            ],
            [
                'id' => 17,
                'grupo' => 'ESGOTO',
                'codigo' => 'A022',
                'residuo_classes_id' => 2,
                'codigo_ibama' => '20 03 06',
                'descricao' => 'Resíduos da limpeza de esgotos, bueiros e bocas-de-lobo – ',
            ],
            [
                'id' => 18,
                'grupo' => 'PAPEL',
                'codigo' => 'A006',
                'residuo_classes_id' => 3,
                'codigo_ibama' => '15 01 01',
                'descricao' => 'Embalagens de papel e cartão – ',
            ],
            [
                'id' => 19,
                'grupo' => 'PLASTICO',
                'codigo' => 'A007',
                'residuo_classes_id' => 3,
                'codigo_ibama' => '15 01 02',
                'descricao' => 'Embalagens de plástico – ',
            ],
            [
                'id' => 20,
                'grupo' => 'MADEIRA',
                'codigo' => 'A099',
                'residuo_classes_id' => 3,
                'codigo_ibama' => '15 01 03',
                'descricao' => 'Embalagens de madeira – ',
            ],
            [
                'id' => 21,
                'grupo' => 'TAMBOR',
                'codigo' => 'A204',
                'residuo_classes_id' => 3,
                'codigo_ibama' => '15 01 04',
                'descricao' => 'Embalagens de metal – ',
            ],
            [
                'id' => 22,
                'grupo' => 'TETRAPACK',
                'codigo' => 'A006',
                'residuo_classes_id' => 3,
                'codigo_ibama' => '15 01 05',
                'descricao' => 'Embalagens longa-vida – ',
            ],
            [
                'id' => 23,
                'grupo' => 'VIDRO',
                'codigo' => 'A117',
                'residuo_classes_id' => 3,
                'codigo_ibama' => '15 01 07',
                'descricao' => 'Embalagens de vidro – ',
            ],
            [
                'id' => 24,
                'grupo' => 'Não Metais',
                'codigo' => 'A005',
                'residuo_classes_id' => 3,
                'codigo_ibama' => '17 04 02',
                'descricao' => 'Alumínio – ',
            ],
            [
                'id' => 25,
                'grupo' => 'Metal',
                'codigo' => 'A004',
                'residuo_classes_id' => 3,
                'codigo_ibama' => '17 04 07',
                'descricao' => 'Mistura de sucatas – ',
            ],
            [
                'id' => 26,
                'grupo' => 'PAPEL',
                'codigo' => 'A006',
                'residuo_classes_id' => 3,
                'codigo_ibama' => '20 01 01',
                'descricao' => 'Papel e cartão – ',
            ],
            [
                'id' => 27,
                'grupo' => 'VIDRO',
                'codigo' => 'A117',
                'residuo_classes_id' => 3,
                'codigo_ibama' => '20 01 02',
                'descricao' => 'Vidro – ',
            ],
            [
                'id' => 28,
                'grupo' => 'MADEIRA',
                'codigo' => 'A099',
                'residuo_classes_id' => 3,
                'codigo_ibama' => '20 01 38',
                'descricao' => 'Madeira não abrangida em 20 01 37 – ',
            ],
            [
                'id' => 29,
                'grupo' => 'PLASTICO',
                'codigo' => 'A007',
                'residuo_classes_id' => 3,
                'codigo_ibama' => '20 01 39',
                'descricao' => 'Plásticos – ',
            ],
            [
                'id' => 30,
                'grupo' => 'Metal',
                'codigo' => 'A004',
                'residuo_classes_id' => 3,
                'codigo_ibama' => '20 01 40',
                'descricao' => 'Metais – ',
            ],
            [
                'id' => 31,
                'grupo' => 'Entulho',
                'codigo' => 'A009',
                'residuo_classes_id' => 3,
                'codigo_ibama' => '20 02 02',
                'descricao' => 'Terras e pedras – ',
            ],
        ];

        DB::table('residuos')->delete();

        foreach ($records as $record) {
            factory(App\Residuos::class)->create($record);
        }
    }
}
