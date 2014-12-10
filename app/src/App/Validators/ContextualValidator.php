<?php namespace App\Validators;

use Crhayes\Validation\ContextualValidator as CrhayesContextualValidator;
use Validator;
use Illuminate\Support\MessageBag;

class ContextualValidator extends CrhayesContextualValidator
{
    /**
     * Add prefix to messages when validating mutidimensional array
     * 
     * @var array
     */
    protected $prefix = '';
    
    protected $fieldNamePattern = '{name}';
    
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }
    
    public function setFieldNamePattern($pattern)
    {
        $this->fieldNamePattern = $pattern;
    }
    
    public function applyFieldNamePattern($key)
    {
        return str_replace('{name}',$key,$this->fieldNamePattern);
    }
    
    /**
     * Perform a validation check against our attributes.
     * 
     * @return boolean
     */
    public function passes()
    {
        $rules = $this->bindReplacements($this->getRulesInContext());

        $validator = Validator::make($this->attributes, $rules, $this->messages);

        $this->addConditionalRules($validator);

        if ($validator->passes()) return true;

        $this->errors = $validator->messages();
        
        $messages = $this->errors->toArray();
        $messagesContextual = array();
        foreach($messages as $key => $message)
        {
            $newKey = $this->prefix.$this->applyFieldNamePattern($key);
            $messagesContextual[$newKey] = $message;
        }
        $this->errors = new MessageBag($messagesContextual);

        return false;
    }
    
}
