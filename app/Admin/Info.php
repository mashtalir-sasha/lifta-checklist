<?php

use App\Info;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Info::class, function (ModelConfiguration $model) {

    $model->disableCreating();
    $model->disableDeleting();

    $model->setTitle('Info');
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::text('title')->setLabel('Заголовок'),
            AdminColumn::text('created_at')->setLabel('Дата создания'),
            AdminColumn::text('updated_at')->setLabel('Дата изменения'),
        ]);
        return $display;
    });

    $model->onCreateAndEdit(function () {

        $form = AdminForm::panel();
        $form->setHtmlAttribute('enctype', 'multipart/form-data');

        $form->addBody([
            AdminFormElement::columns()
                ->addColumn(function () {
                    return [
                        AdminFormElement::text('meta_title', 'Meta title')->required(),
                        AdminFormElement::textarea('meta_description', 'Meta description')->required(),
                    ];
                }, 6)
                ->addColumn(function () {
                    return [
                        AdminFormElement::text('title', 'Заголовок (можно использовать переносы с помощью <br>)')->required(),
                        AdminFormElement::textarea('sub_title', 'Подзаголовок 1')->required(),
                        AdminFormElement::textarea('text', 'Подзаголовок 2'),
                    ];
                }, 6)
                ->addColumn(function () {
                    return [
                        AdminFormElement::text('form_title', 'Заголовок формы (можно использовать переносы с помощью <br>)')->required(),
                        AdminFormElement::text('sender_title', 'Заголовок заявки для CRM')->required(),
                        AdminFormElement::text('form_btn', 'Кнопка формы')->required(),
                        AdminFormElement::text('link', 'Ссылка на файл в окне "Спасибо"')->required(),
                        AdminFormElement::textarea('thanks_text', 'Текст в окне "Спасибо"')->required(),
                    ];
                }, 4)
                ->addColumn(function () {
                    return [
                        AdminFormElement::text('note', 'Текст с обводкой внизу сайта'),
                        AdminFormElement::text('note_xs', 'Текст с обводкой внизу сайта для моб устройств (можно использовать переносы с помощью <br>)'),
                    ];
                }, 4)
                ->addColumn(function () {
                    return [
                        AdminFormElement::image('image', 'Фоновая картинка ПК (ширина 1920px)')->required(),
                        AdminFormElement::image('image_xs', 'Фоновая картинка Моб устройства (ширина 375px)')->required(),
                    ];
                }, 4),
        ]);
        return $form;
    });
})->addMenuPage(Info::class, 1)
    ->setIcon('fa fa-info');