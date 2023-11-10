/*
Parte A
1)
SELECT id,
       name, 
       short_description,
       long_description 
fROM products where short_code not like '%X12345%';
2)
SELECT COUNT(*)
FROM products
WHERE supplier_id = 1
AND DATE(updated_at) = CURDATE();
3)
SELECT DISTINCT (p.duration) 
FROM products p, product_option po 
WHERE p.id = po.product_id 
AND p.reviews_average_rating BETWEEN 4.0 
AND 4.5 AND po.name like '%Adult%';
4)
SELECT supplier_id, MAX(fetched_at) AS ultima_actualizacion
FROM products
GROUP BY supplier_id;
PARTE B
1)
UPDATE products
SET retail_rate_reference = retail_rate_reference * 1.20
WHERE net_rate_reference BETWEEN 100 AND 200;
s
UPDATE product_options
SET updated_at = NOW()
WHERE product_id IN (SELECT product_id FROM products WHERE net_rate_reference BETWEEN 100 AND 200);
*/