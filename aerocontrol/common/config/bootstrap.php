<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

Yii::setAlias('@root', dirname(dirname(__DIR__)));
Yii::setAlias('@uploads', '@root/uploads');
Yii::setAlias('@uploadsUrl', '../../../uploads');
Yii::setAlias('@uploadLogos', '@uploads/logos');
Yii::setAlias('@uploadLogosUrl', '@uploadsUrl/logos');
Yii::setAlias('@uploadLogoRestaurants', '@uploadLogos/restaurants');
Yii::setAlias('@uploadLogoRestaurantsUrl', '@uploadLogosUrl/restaurants');
Yii::setAlias('@uploadLogoStores', '@uploadLogos/stores');
Yii::setAlias('@uploadLogoStoresUrl', '@uploadLogosUrl/stores');
Yii::setAlias('@uploadLostItems', '@uploads/lostitems');
Yii::setAlias('@uploadLostItemsUrl', '@uploadsUrl/lostitems');
Yii::setAlias('@uploadLogoRestaurantItems', '@uploadLogos/restaurants/items');
Yii::setAlias('@uploadLogoRestaurantItemsUrl', '@uploadLogosUrl/restaurants/items');