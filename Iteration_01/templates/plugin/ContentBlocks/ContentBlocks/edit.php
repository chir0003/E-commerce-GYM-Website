<?php
/**
 * @var \App\View\AppView $this
 * @var \ContentBlocks\Model\Entity\ContentBlock $contentBlock
 */

$this->assign('title', 'Edit Content Block - Content Blocks');

$this->Html->script('ContentBlocks.ckeditor/ckeditor', ['block' => true]);
$this->Html->css('ContentBlocks.content-blocks', ['block' => true]);
?>

<style>
    .ck-editor__editable_inline {
        min-height: 25rem;
    }
</style>

<div class="container mt-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h3 class="mb-0"><?= __('Edit Content Block') ?> - <?= $contentBlock->label ?></h3>
        </div>

        <div class="card-body">
            <p class="mb-3 text-muted"><?= $contentBlock->description ?></p>

            <?= $this->Form->create($contentBlock, ['type' => 'file', 'class' => 'form']) ?>

            <?php if ($contentBlock->type === 'text') { ?>
                <div class="mb-3">
                    <?= $this->Form->control('value', [
                        'type' => 'text',
                        'value' => html_entity_decode($contentBlock->value),
                        'label' => 'Content Text',
                        'class' => 'form-control',
                    ]) ?>
                </div>
            <?php } else if ($contentBlock->type === 'html') { ?>
                <div class="mb-3">
                    <?= $this->Form->control('value', [
                        'type' => 'textarea',
                        'label' => 'Content HTML',
                        'id' => 'content-value-input',
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        CKSource.Editor.create(document.getElementById('content-value-input'), {
                            toolbar: [
                                "heading", "|",
                                "bold", "italic", "underline", "|",
                                "bulletedList", "numberedList", "|",
                                "alignment", "blockQuote", "|",
                                "indent", "outdent", "|",
                                "link", "|",
                                "insertTable", "imageInsert", "mediaEmbed", "horizontalLine", "|",
                                "removeFormat", "|",
                                "sourceEditing", "|",
                                "undo", "redo"
                            ],
                            simpleUpload: {
                                uploadUrl: <?= json_encode($this->Url->build(['action' => 'upload'])) ?>,
                                headers: {
                                    'X-CSRF-TOKEN': <?= json_encode($this->request->getAttribute('csrfToken')) ?>
                                }
                            }
                        }).then(editor => {
                            console.log('CKEditor loaded:', editor);
                        });
                    });
                </script>

            <?php } else if ($contentBlock->type === 'image') { ?>
                <div class="mb-3">
                    <?php if ($contentBlock->value) { ?>
                        <div class="mb-3">
                            <?= $this->Html->image($contentBlock->value, ['class' => 'img-fluid rounded mb-3', 'alt' => 'Current Image']) ?>
                        </div>
                    <?php } ?>
                    <?= $this->Form->control('value', [
                        'type' => 'file',
                        'accept' => 'image/*',
                        'label' => 'Upload Image',
                        'class' => 'form-control'
                    ]) ?>
                </div>
            <?php } ?>

            <div class="d-flex justify-content-between mt-4">
                <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success']) ?>
                <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
