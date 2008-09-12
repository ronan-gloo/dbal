<?php
/*
 *  $Id$
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information, see
 * <http://www.phpdoctrine.org>.
 */

/**
 * FromClause ::= "FROM" IdentificationVariableDeclaration {"," IdentificationVariableDeclaration}
 *
 * @package     Doctrine
 * @subpackage  Query
 * @author      Guilherme Blanco <guilhermeblanco@hotmail.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        http://www.phpdoctrine.org
 * @since       2.0
 * @version     $Revision$
 */
class Doctrine_Query_AST_FromClause extends Doctrine_Query_AST
{
    protected $_identificationVariableDeclarations = array();
    

    /* Setters */
    public function addIdentificationVariableDeclaration($identificationVariableDeclaration)
    {
        $this->_identificationVariableDeclarations[] = $identificationVariableDeclaration;
    }


    public function setIdentificationVariableDeclarations($identificationVariableDeclarations, $append = false)
    {
        $this->_selectExpressions = ($append === true)
            ? array_merge($this->_identificationVariableDeclarations, $identificationVariableDeclarations)
            : $identificationVariableDeclarations;
    }
    
    
    /* Getters */
    public function getIdentificationVariableDeclarations()
    {
        return $this->_identificationVariableDeclarations;
    }
    
    
    /* REMOVE ME LATER. COPIED METHODS FROM SPLIT OF PRODUCTION INTO "AST" AND "PARSER" */
    
    public function buildSql()
    {
        //echo "FromClause:\n";
        //for ($i = 0; $i < count($this->_identificationVariableDeclaration);$i++) {
        //    echo (($this->_identificationVariableDeclaration[$i] instanceof IdentificationVariableDeclaration) 
        //        ? get_class($this->_identificationVariableDeclaration[$i]) 
        //        : get_class($this->_identificationVariableDeclaration[$i])) . "\n";
        //}

        return 'FROM ' . implode(', ', $this->_mapIdentificationVariableDeclarations());
    }


    protected function _mapIdentificationVariableDeclarations()
    {
        return array_map(
            array(&$this, '_mapIdentificationVariableDeclaration'), $this->_identificationVariableDeclarations
        );
    }


    protected function _mapIdentificationVariableDeclaration($value)
    {
        return $value->buildSql();
    }
}