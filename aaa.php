const CARD_RULES = {
  Platinum: { interestRate: 20, creditLimit: 100000 },
  Sapphire: { interestRate: 18, creditLimit: 150000 },
  Emerald: { interestRate: 15, creditLimit: 200000 },
  Black: { interestRate: 12, creditLimit: 500000 },
};



<span className="value">
      {rules.creditLimit
        ? `Rs. ${rules.creditLimit.toLocaleString()}`
        : "Rs. --"}
    </span>


<span className="value">
      {rules.interestRate ? `${rules.interestRate}%` : "--"}
    </span>