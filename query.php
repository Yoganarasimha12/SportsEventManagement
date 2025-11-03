INSERT INTO credit_card_details (
    application_id,
    card_type,
    card_number,
    cvv,
    expiry_date,
    generated_at,
    card_status
) VALUES (
    'SA0003',                -- must match an existing application_id in the "application" table
    'Platinum',              -- or whatever type exists in your application table
    '1234567812345678',      -- 16-digit number
    '789',                   -- 3-digit CVV
    '2029-10-30',            -- expiry date (YYYY-MM-DD)
    NOW(),                   -- generatedAt (auto-set to current timestamp)
    'Pending'                -- default status
);


