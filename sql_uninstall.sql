ALTER TABLE orders DROP shipping_module;
DELETE FROM configuration_group WHERE configuration_group_id IN (SELECT configuration_group_id from configuration WHERE configuration_key LIKE 'ORDER_EDITOR_%');
DELETE FROM configuration WHERE configuration_key LIKE 'ORDER_EDITOR_%';