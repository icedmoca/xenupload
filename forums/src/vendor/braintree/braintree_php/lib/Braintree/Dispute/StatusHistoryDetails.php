<?php
namespace Braintree\Dispute;

use Braintree\Instance;

/**
 * Evidence details for a dispute
 *
 * @package    Braintree
 *
 * @property-read string $effective_date
 * @property-read string $status
 * @property-read date   $timestamp
 */
class StatusHistoryDetails extends Instance
{
}

class_alias('Braintree\Dispute\StatusHistoryDetails', 'Braintree_Dispute_StatusHistoryDetails');
