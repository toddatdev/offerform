SET GLOBAL log_bin_trust_function_creators = 1;
DELIMITER $$
CREATE FUNCTION `getDisplayOrder`(offerFormId INT, display_order INT, referralPartnerId varchar(1000)) RETURNS int
BEGIN
	DECLARE displayOrder INT;
	IF referralPartnerId IS NULL THEN SET displayOrder = display_order;
ELSE
		set displayOrder = (
			SELECT ofrpt.display_order FROM `offer_form_referral_partner_type`  ofrpt
                JOIN referral_partners rp ON rp.referral_partner_type_id = ofrpt.referral_partner_type_id
				WHERE ofrpt.offer_form_id=offerFormId AND rp.id=referralPartnerId

			);
            IF displayOrder IS NULL THEN SET displayOrder = display_order; END IF;
END IF;
RETURN displayOrder;
END
