<?php
namespace App\Test\TestCase\Controller;

use App\Controller\EmpresasUsuariosController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\EmpresasUsuariosController Test Case
 */
class EmpresasUsuariosControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.empresas_usuarios',
        'app.empresas',
        'app.entradas',
        'app.documentos',
        'app.procedencias',
        'app.navio_viagens',
        'app.tipo_naturezas',
        'app.lotes',
        'app.tipo_conhecimentos',
        'app.moedas',
        'app.anexos',
        'app.carga_gerais',
        'app.codigo_onus',
        'app.embalagens',
        'app.containers',
        'app.iso_codes',
        'app.itens',
        'app.item_agendamentos',
        'app.agendamentos',
        'app.usuarios',
        'app.aros',
        'app.acos',
        'app.permissions',
        'app.perfis',
        'app.operacoes',
        'app.horarios',
        'app.operacao_documentos',
        'app.paises',
        'app.cliente',
        'app.despachante',
        'app.representante'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
