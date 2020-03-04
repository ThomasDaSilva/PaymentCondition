<?php

namespace PaymentCondition\Model\Base;

use \Exception;
use \PDO;
use PaymentCondition\Model\PaymentCustomerFamilyCondition as ChildPaymentCustomerFamilyCondition;
use PaymentCondition\Model\PaymentCustomerFamilyConditionQuery as ChildPaymentCustomerFamilyConditionQuery;
use PaymentCondition\Model\Map\PaymentCustomerFamilyConditionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Thelia\Model\Module;

/**
 * Base class that represents a query for the 'payment_customer_family_condition' table.
 *
 *
 *
 * @method     ChildPaymentCustomerFamilyConditionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPaymentCustomerFamilyConditionQuery orderByPaymentModuleId($order = Criteria::ASC) Order by the payment_module_id column
 * @method     ChildPaymentCustomerFamilyConditionQuery orderByCustomerFamilyId($order = Criteria::ASC) Order by the customer_family_id column
 * @method     ChildPaymentCustomerFamilyConditionQuery orderByIsValid($order = Criteria::ASC) Order by the is_valid column
 *
 * @method     ChildPaymentCustomerFamilyConditionQuery groupById() Group by the id column
 * @method     ChildPaymentCustomerFamilyConditionQuery groupByPaymentModuleId() Group by the payment_module_id column
 * @method     ChildPaymentCustomerFamilyConditionQuery groupByCustomerFamilyId() Group by the customer_family_id column
 * @method     ChildPaymentCustomerFamilyConditionQuery groupByIsValid() Group by the is_valid column
 *
 * @method     ChildPaymentCustomerFamilyConditionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPaymentCustomerFamilyConditionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPaymentCustomerFamilyConditionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPaymentCustomerFamilyConditionQuery leftJoinModule($relationAlias = null) Adds a LEFT JOIN clause to the query using the Module relation
 * @method     ChildPaymentCustomerFamilyConditionQuery rightJoinModule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Module relation
 * @method     ChildPaymentCustomerFamilyConditionQuery innerJoinModule($relationAlias = null) Adds a INNER JOIN clause to the query using the Module relation
 *
 * @method     ChildPaymentCustomerFamilyCondition findOne(ConnectionInterface $con = null) Return the first ChildPaymentCustomerFamilyCondition matching the query
 * @method     ChildPaymentCustomerFamilyCondition findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPaymentCustomerFamilyCondition matching the query, or a new ChildPaymentCustomerFamilyCondition object populated from the query conditions when no match is found
 *
 * @method     ChildPaymentCustomerFamilyCondition findOneById(int $id) Return the first ChildPaymentCustomerFamilyCondition filtered by the id column
 * @method     ChildPaymentCustomerFamilyCondition findOneByPaymentModuleId(int $payment_module_id) Return the first ChildPaymentCustomerFamilyCondition filtered by the payment_module_id column
 * @method     ChildPaymentCustomerFamilyCondition findOneByCustomerFamilyId(int $customer_family_id) Return the first ChildPaymentCustomerFamilyCondition filtered by the customer_family_id column
 * @method     ChildPaymentCustomerFamilyCondition findOneByIsValid(int $is_valid) Return the first ChildPaymentCustomerFamilyCondition filtered by the is_valid column
 *
 * @method     array findById(int $id) Return ChildPaymentCustomerFamilyCondition objects filtered by the id column
 * @method     array findByPaymentModuleId(int $payment_module_id) Return ChildPaymentCustomerFamilyCondition objects filtered by the payment_module_id column
 * @method     array findByCustomerFamilyId(int $customer_family_id) Return ChildPaymentCustomerFamilyCondition objects filtered by the customer_family_id column
 * @method     array findByIsValid(int $is_valid) Return ChildPaymentCustomerFamilyCondition objects filtered by the is_valid column
 *
 */
abstract class PaymentCustomerFamilyConditionQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \PaymentCondition\Model\Base\PaymentCustomerFamilyConditionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\PaymentCondition\\Model\\PaymentCustomerFamilyCondition', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPaymentCustomerFamilyConditionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPaymentCustomerFamilyConditionQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \PaymentCondition\Model\PaymentCustomerFamilyConditionQuery) {
            return $criteria;
        }
        $query = new \PaymentCondition\Model\PaymentCustomerFamilyConditionQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPaymentCustomerFamilyCondition|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PaymentCustomerFamilyConditionTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PaymentCustomerFamilyConditionTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return   ChildPaymentCustomerFamilyCondition A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, PAYMENT_MODULE_ID, CUSTOMER_FAMILY_ID, IS_VALID FROM payment_customer_family_condition WHERE ID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildPaymentCustomerFamilyCondition();
            $obj->hydrate($row);
            PaymentCustomerFamilyConditionTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildPaymentCustomerFamilyCondition|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ChildPaymentCustomerFamilyConditionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PaymentCustomerFamilyConditionTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildPaymentCustomerFamilyConditionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PaymentCustomerFamilyConditionTableMap::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPaymentCustomerFamilyConditionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PaymentCustomerFamilyConditionTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PaymentCustomerFamilyConditionTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PaymentCustomerFamilyConditionTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the payment_module_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentModuleId(1234); // WHERE payment_module_id = 1234
     * $query->filterByPaymentModuleId(array(12, 34)); // WHERE payment_module_id IN (12, 34)
     * $query->filterByPaymentModuleId(array('min' => 12)); // WHERE payment_module_id > 12
     * </code>
     *
     * @see       filterByModule()
     *
     * @param     mixed $paymentModuleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPaymentCustomerFamilyConditionQuery The current query, for fluid interface
     */
    public function filterByPaymentModuleId($paymentModuleId = null, $comparison = null)
    {
        if (is_array($paymentModuleId)) {
            $useMinMax = false;
            if (isset($paymentModuleId['min'])) {
                $this->addUsingAlias(PaymentCustomerFamilyConditionTableMap::PAYMENT_MODULE_ID, $paymentModuleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($paymentModuleId['max'])) {
                $this->addUsingAlias(PaymentCustomerFamilyConditionTableMap::PAYMENT_MODULE_ID, $paymentModuleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PaymentCustomerFamilyConditionTableMap::PAYMENT_MODULE_ID, $paymentModuleId, $comparison);
    }

    /**
     * Filter the query on the customer_family_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomerFamilyId(1234); // WHERE customer_family_id = 1234
     * $query->filterByCustomerFamilyId(array(12, 34)); // WHERE customer_family_id IN (12, 34)
     * $query->filterByCustomerFamilyId(array('min' => 12)); // WHERE customer_family_id > 12
     * </code>
     *
     * @param     mixed $customerFamilyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPaymentCustomerFamilyConditionQuery The current query, for fluid interface
     */
    public function filterByCustomerFamilyId($customerFamilyId = null, $comparison = null)
    {
        if (is_array($customerFamilyId)) {
            $useMinMax = false;
            if (isset($customerFamilyId['min'])) {
                $this->addUsingAlias(PaymentCustomerFamilyConditionTableMap::CUSTOMER_FAMILY_ID, $customerFamilyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($customerFamilyId['max'])) {
                $this->addUsingAlias(PaymentCustomerFamilyConditionTableMap::CUSTOMER_FAMILY_ID, $customerFamilyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PaymentCustomerFamilyConditionTableMap::CUSTOMER_FAMILY_ID, $customerFamilyId, $comparison);
    }

    /**
     * Filter the query on the is_valid column
     *
     * Example usage:
     * <code>
     * $query->filterByIsValid(1234); // WHERE is_valid = 1234
     * $query->filterByIsValid(array(12, 34)); // WHERE is_valid IN (12, 34)
     * $query->filterByIsValid(array('min' => 12)); // WHERE is_valid > 12
     * </code>
     *
     * @param     mixed $isValid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPaymentCustomerFamilyConditionQuery The current query, for fluid interface
     */
    public function filterByIsValid($isValid = null, $comparison = null)
    {
        if (is_array($isValid)) {
            $useMinMax = false;
            if (isset($isValid['min'])) {
                $this->addUsingAlias(PaymentCustomerFamilyConditionTableMap::IS_VALID, $isValid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isValid['max'])) {
                $this->addUsingAlias(PaymentCustomerFamilyConditionTableMap::IS_VALID, $isValid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PaymentCustomerFamilyConditionTableMap::IS_VALID, $isValid, $comparison);
    }

    /**
     * Filter the query by a related \Thelia\Model\Module object
     *
     * @param \Thelia\Model\Module|ObjectCollection $module The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPaymentCustomerFamilyConditionQuery The current query, for fluid interface
     */
    public function filterByModule($module, $comparison = null)
    {
        if ($module instanceof \Thelia\Model\Module) {
            return $this
                ->addUsingAlias(PaymentCustomerFamilyConditionTableMap::PAYMENT_MODULE_ID, $module->getId(), $comparison);
        } elseif ($module instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PaymentCustomerFamilyConditionTableMap::PAYMENT_MODULE_ID, $module->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByModule() only accepts arguments of type \Thelia\Model\Module or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Module relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildPaymentCustomerFamilyConditionQuery The current query, for fluid interface
     */
    public function joinModule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Module');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Module');
        }

        return $this;
    }

    /**
     * Use the Module relation Module object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Thelia\Model\ModuleQuery A secondary query class using the current class as primary query
     */
    public function useModuleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinModule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Module', '\Thelia\Model\ModuleQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPaymentCustomerFamilyCondition $paymentCustomerFamilyCondition Object to remove from the list of results
     *
     * @return ChildPaymentCustomerFamilyConditionQuery The current query, for fluid interface
     */
    public function prune($paymentCustomerFamilyCondition = null)
    {
        if ($paymentCustomerFamilyCondition) {
            $this->addUsingAlias(PaymentCustomerFamilyConditionTableMap::ID, $paymentCustomerFamilyCondition->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the payment_customer_family_condition table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PaymentCustomerFamilyConditionTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PaymentCustomerFamilyConditionTableMap::clearInstancePool();
            PaymentCustomerFamilyConditionTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildPaymentCustomerFamilyCondition or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildPaymentCustomerFamilyCondition object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PaymentCustomerFamilyConditionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PaymentCustomerFamilyConditionTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        PaymentCustomerFamilyConditionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PaymentCustomerFamilyConditionTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // PaymentCustomerFamilyConditionQuery
